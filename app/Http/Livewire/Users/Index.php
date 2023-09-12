<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;

class Index extends Component
{
    use WithPagination, Actions;

    // filters
    public $search = '';

    protected $queryString = ['search' => ['except' => '']];

    // modals
    public $showCreateModal = false;

    public $showEditModal = false;

    // models and collections
    public $roles = [];

    // forms
    public $createForm = [
        'name' => '',
        'email' => '',
        'password' => '',
    ];

    public $editForm = [
        'id' => '',
        'name' => '',
        'email' => '',
        'role' => '',
        'is_active' => 1,
    ];

    public function store()
    {
        if (auth()->user()->cannot('create user')) {
            $this->notification()->error('You are not authorized to create user');

            return;
        }

        $this->validateCreateUserForm();

        DB::beginTransaction();

        $role = Role::findOrFail($this->createForm['role']);
        $user = User::create([
            'name' => $this->createForm['name'],
            'email' => $this->createForm['email'],
            'password' => bcrypt($this->createForm['password']),
            'created_by' => auth()->id(),
        ]);

        $user->assignRole($role);

        DB::commit();
        $this->createForm = [
            'name' => '',
            'email' => '',
            'password' => '',
        ];

        $this->showCreateModal = false;

        $this->notification()->success('User created successfully');
    }

    public function validateCreateUserForm()
    {
        $this->validate([
            'createForm.name' => 'required|string',
            'createForm.email' => 'required|email|unique:users,email',
            'createForm.password' => 'required|string|min:8',
            'createForm.role' => 'required|exists:roles,id',
        ], [], [
            'createForm.name' => 'name',
            'createForm.email' => 'email',
            'createForm.password' => 'password',
            'createForm.role' => 'role',
        ]);
    }

    public function edit($id)
    {
        if (auth()->user()->cannot('edit user')) {
            $this->notification()->error('You are not authorized to edit user');

            return;
        }

        $this->editable = User::findOrFail($id);

        $this->editForm = [
            'name' => $this->editable->name,
            'email' => $this->editable->email,
            'role' => $this->editable->roles->first()->id,
            'is_active' => $this->editable->is_active,
        ];

        $this->showEditModal = true;
    }

    public function update()
    {
        if (auth()->user()->cannot('edit user')) {
            $this->notification()->error('You are not authorized to edit user');

            return;
        }

        $this->validateEditUserForm();

        DB::beginTransaction();

        $role = Role::findById($this->editForm['role']);

        DB::table('model_has_roles')->where('model_id', $this->editable->id)->delete();

        $this->editable->assignRole([$role]);

        $this->editable->update([
            'name' => $this->editForm['name'],
            'email' => $this->editForm['email'],
            'is_active' => $this->editForm['is_active'] == 1 ? true : false,
        ]);

        DB::commit();

        $this->showEditModal = false;

        $this->notification()->success('User updated successfully');
    }

    public function validateEditUserForm()
    {
        $this->validate([
            'editForm.name' => 'required|string',
            'editForm.email' => 'required|email|unique:users,email,'.$this->editable->id,
            'editForm.role' => 'required|exists:roles,id',
            'editForm.is_active' => 'required|in:0,1',
        ], [], [
            'editForm.name' => 'name',
            'editForm.email' => 'email',
            'editForm.role' => 'role',
            'editForm.status' => 'is active',
        ]);
    }

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();

        $this->notification()->success(
            $title='Success',
            $description='User has been deleted successfully',
        );
    }

    public function render()
    {
        return view('livewire.users.index', [
            'users' => User::query()
                ->when($this->search, fn ($query) => $query->where('name', 'like', '%'.$this->search.'%'))
                ->with(['creator', 'roles'])
                ->paginate(10),
        ]);
    }
}
