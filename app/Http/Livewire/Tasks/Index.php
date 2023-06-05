<?php

namespace App\Http\Livewire\Tasks;

use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use App\Models\{Category, Company,Segment,Task};

class Index extends Component
{
    use WithPagination, Actions;
    //filters
    public $c_id = ""; // company id
    public $s_id = ""; // segment id
    public $queryString = [
        'c_id'=>['except'=>''],
        's_id'=>['except'=>''],
    ];

    // models and collections
    public $company = null;
    public $companies = [];
    public $categories = [];
    public $editableTask = null;



    // modals
    public $showCreateSegmentModal = false;
    public $showCreateTaskModal = false;
    public $showEditTaskModal = false;


    // forms
    public $createSegmentForm = [
        'name' => '',
    ];
    public $createTaskForm = [
        'name' => '',
        'category_id' => '',
        'is_document_review_reference' => 0,
        'per_company_in_review' => 0,
        'review_starter'=>0,
    ];
    public $editTaskForm = [
        'name' => '',
        'category_id' => '',
        'is_document_review_reference' => 0,
        'per_company_in_review' => 0,
        'review_starter'=>0,
    ];

    public function storeSegment()
    {
        if (auth()->user()->cannot('create company segments')) {
            $this->notification()->error('You are not authorized to create segments');
            return;
        }

        $this->validate([
            'createSegmentForm.name' => 'required|string|unique:segments,name,NULL,id,company_id,'.$this->company->id,
        ],[],[
            'createSegmentForm.name' => 'segment name',
        ]);

        $this->company->segments()->create([
            'name' => $this->createSegmentForm['name'],
        ]);

        $this->notification()->success('Segment created successfully');

        $this->showCreateSegmentModal = false;

        $this->createSegmentForm = [
            'name' => '',
        ];
    }

    public function storeTask()
    {
        if (auth()->user()->cannot('create company tasks')) {
            $this->notification()->error('You are not authorized to create tasks');
            return;
        }

        $this->validate([
            'createTaskForm.name' => 'required|string',
            'createTaskForm.category_id' => 'required|exists:categories,id',
            'createTaskForm.is_document_review_reference' => 'nullable|in:0,1',
            'createTaskForm.per_company_in_review' => 'nullable|in:0,1',
            'createTaskForm.review_starter' => 'nullable|in:0,1',
        ],[],[
            'createTaskForm.name' => 'task name',
            'createTaskForm.category_id' => 'category',
            'createTaskForm.review_starter' => 'Ref for (Start Review)',
        ]);

        Task::create([
            'name' => $this->createTaskForm['name'],
            'category_id' => $this->createTaskForm['category_id'],
            'segment_id' => $this->s_id,
            'created_by' => auth()->id(),
            'is_document_review_reference' => $this->createTaskForm['is_document_review_reference'],
            'count_per_company_review'=> $this->createTaskForm['per_company_in_review'],
            'review_starter'=> $this->createTaskForm['review_starter'],
        ]);

        $this->notification()->success('Task created successfully');

        $this->createTaskForm = [
            'name' => '',
            'category_id' => '',
        ];

        $this->showCreateTaskModal = false;
    }

    public function editTask($id)
    {
        if (auth()->user()->cannot('edit company tasks')) {
            $this->notification()->error('You are not authorized to edit tasks');
            return;
        }

        $this->editableTask = Task::find($id);

        $this->editTaskForm = [
            'name' => $this->editableTask->name,
            'category_id' => $this->editableTask->category_id,
            'is_document_review_reference' => $this->editableTask->is_document_review_reference,
            'per_company_in_review' => $this->editableTask->count_per_company_review,
            'review_starter' => $this->editableTask->review_starter,
        ];

        $this->showEditTaskModal = true;

    }

    public function updateTask()
    {
        if (auth()->user()->cannot('edit company tasks')) {
            $this->notification()->error('You are not authorized to edit tasks');
            return;
        }
        $this->validate([
            'editTaskForm.name' => 'required|string',
            'editTaskForm.category_id' => 'required|exists:categories,id',
            'editTaskForm.is_document_review_reference' => 'nullable|in:0,1',
            'editTaskForm.per_company_in_review' => 'nullable|in:0,1',
            'editTaskForm.review_starter' => 'nullable|in:0,1',
        ],[],[
            'editTaskForm.name' => 'task name',
            'editTaskForm.category_id' => 'category',
            'editTaskForm.is_document_review_reference' => ' document review reference',
            'editTaskForm.per_company_in_review' => 'per company in review',
            'editTaskForm.review_starter' => 'Ref for (Start Review)',
        ]);

        $this->editableTask->update([
            'name' => $this->editTaskForm['name'],
            'category_id' => $this->editTaskForm['category_id'],
            'is_document_review_reference' => $this->editTaskForm['is_document_review_reference'],
            'count_per_company_review'=> $this->editTaskForm['per_company_in_review'],
            'review_starter'=> $this->editTaskForm['review_starter'],
        ]);

        $this->notification()->success('Task updated successfully');

        $this->showEditTaskModal = false;

        $this->editTaskForm = [
            'name' => '',
            'category_id' => '',
        ];

        $this->editableTask = null;
    }

    public function mount()
    {
        $this->companies = Company::all();
        $this->categories = Category::all();
    }
    public function render()
    {
        $this->company = $this->loadCompany();
        return view('livewire.tasks.index',[
            'segments' => $this->loadSegments(),
            'tasks' => $this->company ? 
                    Task::whereHas('segment',function($q){
                        $q->where('company_id',$this->company->id);
                    })
                    ->when($this->s_id != "",function($q){
                        $q->where('segment_id',$this->s_id);
                    })
                    ->with(['segment','creator','category'])
                    ->paginate(10) : [],
        ]);
    }

    private function loadCompany()
    {
        return $this->c_id != "" ? Company::find($this->c_id) : null;
    }

    public function loadSegments()
    {
        return $this->company != null ? $this->company->segments : [];
    }
}
