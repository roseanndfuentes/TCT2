<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;

class Index extends Component
{
    use WithPagination, Actions;

    // filters

    // modals
    public $showCreateModal = false;

    public $showEditModal = false;

    // models and collections
    public $editable = null;

    // forms
    public $createForm = [
        'name' => '',
    ];

    public $editForm = [
        'name' => '',
    ];

    public function validateCreateRoleForm()
    {
        $this->validate([
            'createForm.name' => 'required',
        ], [], [
            'createForm.name' => 'Name',
        ]);
    }

    public function store()
    {
        if (auth()->user()->cannot('create role')) {
            $this->notification()->error('You are not authorized to create role');

            return;
        }

        $this->validateCreateRoleForm();

        Role::create([
            'name' => strtoupper($this->createForm['name']),
        ]);

        $this->showCreateModal = false;

        $this->createForm = [
            'name' => '',
        ];

        $this->notification()->success('Role created successfully');
    }

    public function edit(Role $role)
    {
        if (auth()->user()->cannot('edit role')) {
            $this->notification()->error('You are not authorized to update role');

            return;
        }

        $this->editable = $role;

        $this->editForm = [
            'name' => $role->name,
        ];

        $this->showEditModal = true;
    }

    public function update()
    {
        if (auth()->user()->cannot('edit role')) {
            $this->notification()->error('You are not authorized to update role');

            return;
        }

        $this->validate([
            'editForm.name' => 'required',
        ], [], [
            'editForm.name' => 'Name',
        ]);

        $this->editable->update([
            'name' => strtoupper($this->editForm['name']),
        ]);

        $this->showEditModal = false;

        $this->notification()->success('Role updated successfully');
    }

    public function render()
    {
        return view('livewire.roles.index', [
            'roles' => Role::paginate(10),
        ]);
    }
}
