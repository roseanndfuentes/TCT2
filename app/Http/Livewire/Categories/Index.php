<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
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
    public $formulas = Category::FORMULAS;


    // forms
    public $createForm =  [
        'name' => '',
        'is_active' => true,
        'formula' => '',
        'created_by' => '',
    ];
    public $editForm =  [
        'name' => '',
    ];

    public function store()
    {
        if(auth()->user()->cannot('create category')) {
            $this->notification()->error('You are not authorized to create category');
            return;
        }

        $this->validateCreateCategoryForm();

        Category::create([
            'name' => $this->createForm['name'],
            'formula' => $this->createForm['formula'],
            'created_by' => $this->createForm['created_by'],
        ]);

        $this->createForm =  [
            'name' => '',
            'is_active' => true,
            'formula' => '',
            'created_by' => '',
        ];

        $this->notification()->success('Category created successfully');

        $this->showCreateModal = false;
    }

    public function edit(Category $category)
    {
        if(auth()->user()->cannot('edit category')) {
            $this->notification()->error('You are not authorized to update category');
            return;
        }
        $this->editable = $category;

        $this->editForm['name'] = $category->name;
        
        $this->showEditModal = true;
    }

    public function update()
    {
        if(auth()->user()->cannot('edit category')) {
            $this->notification()->error('You are not authorized to update category');
            return;
        }

        $this->validateEditCategoryForm();

        $this->editable->update([
            'name' => $this->editForm['name']
        ]);

        $this->editForm =  [
            'name' => '',
        ];

        $this->notification()->success('Category updated successfully');

        $this->showEditModal = false;
    }

    public function validateEditCategoryForm()
    {
        $this->validate([
            'editForm.name' => 'required',
        ], [], [
            'editForm.name' => 'Name',
        ]);
    }

    public function validateCreateCategoryForm()
    {
        $this->createForm['created_by'] = auth()->user()->id;
        $this->validate([
            'createForm.name' => 'required',
            'createForm.formula' => 'required',
        ], [], [
            'createForm.name' => 'Name',
            'createForm.formula' => 'Formula',
        ]);
    }

    public function render()
    {
        return view('livewire.categories.index', [
            'categories' => Category::query()
                ->when($this->search != '', fn ($query) => $query->where('name', 'like', "%{$this->search}%"))
                ->with('creator')
                ->withCount('companies')
                ->paginate(10)
        ]);
    }
}
