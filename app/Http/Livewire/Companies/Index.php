<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
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
    public $editable = null;


    // forms
    public $createForm =  [
        'name' => '',
        'created_by' => '',
    ];
    public $editForm =  [
        'name' => '',
    ];


    public function validateEditCompanyForm()
    {
        $this->validate([
            'editForm.name' => 'required',
        ], [], [
            'editForm.name' => 'Name',
        ]);
    }

    public function validateCreateCompanyForm()
    {
        $this->createForm['created_by'] = auth()->user()->id;
        $this->validate([
            'createForm.name' => 'required',
        ], [], [
            'createForm.name' => 'Name',
        ]);
    }



    public function store()
    {
        if (auth()->user()->cannot('create company')) {
            $this->notification()->error('You are not authorized to create company');
            $this->showCreateModal = false;
            return;
        }

        $this->validateCreateCompanyForm();

        Company::create([
            'name' => $this->createForm['name'],
            'created_by' => $this->createForm['created_by'],
        ]);

        $this->notification()->success('Company created successfully');

        $this->showCreateModal = false;
    }

    public function edit(Company $company)
    {
        if (auth()->user()->cannot('edit company')) {
            $this->notification()->error('You are not authorized to edit company');
            return;
        }

        $this->editable = $company;

        $this->editForm['name'] = $company->name;
        
        $this->showEditModal = true;
    }

    public function update()
    {
        if (auth()->user()->cannot('edit company')) {
            $this->notification()->error('You are not authorized to edit company');
            $this->showEditModal = false;
            return;
        }

        $this->validateEditCompanyForm();

        $this->editable->update([
            'name' => $this->editForm['name']
        ]);

        $this->notification()->success('Company updated successfully');

        $this->showEditModal = false;
    }


    public function render()
    {
        return view('livewire.companies.index', [
            'companies' => Company::query()
                ->when($this->search != '', fn ($query) => $query->where('name', 'like', "%{$this->search}%"))
                ->with('creator')
                ->paginate(10)
        ]);
    }
}
