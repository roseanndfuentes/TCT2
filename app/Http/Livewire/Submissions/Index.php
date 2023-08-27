<?php

namespace App\Http\Livewire\Submissions;

use App\Models\Company;
use App\Models\Form;
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
    public $showStartFormModal = false;

    // models and collections
    public $editable = null;

    public $companies = [];

    public $segments = [];

    public $tasks = [];

    public $statuses = Form::STATUSES;

    // forms
    public $createForm = [
        'company_id' => '',
        'segment_id' => '',
        'task_id' => '',
    ];

    public function updatedCreateFormCompanyId()
    {
        $this->segments = $this->createForm['company_id'] ? $this->companies->find($this->createForm['company_id'])->segments : [];
        $this->tasks = [];
    }

    public function updatedCreateFormSegmentId()
    {
        $this->tasks = $this->createForm['segment_id'] ? $this->segments->find($this->createForm['segment_id'])->tasks : [];
    }

    public function validateCreateSubmissionForm()
    {
        $this->validate([
            'createForm.company_id' => 'required',
            'createForm.segment_id' => 'required',
            'createForm.task_id' => 'required',
        ], [], [
            'createForm.company_id' => 'Company',
            'createForm.segment_id' => 'Segment',
            'createForm.task_id' => 'Task',
        ]);
    }

    public function store()
    {
        if (auth()->user()->cannot('start form')) {
            $this->dialog()->error('You are not authorized to start form');

            $this->showStartFormModal = false;

            return;
        }

        $this->validateCreateSubmissionForm();
        $form =  Form::create([
            'status' => Form::IN_PROGRESS,
            'record_number' => $this->generateRecordNumber(),
            'submitted_by' => auth()->user()->id,
            'start_time' => now(),
            'company_id' => $this->createForm['company_id'],
            'segment_id' => $this->createForm['segment_id'],
            'task_id' => $this->createForm['task_id'],
            'category_id' => $this->tasks->find($this->createForm['task_id'])->category_id,
        ]);
        return redirect()->route('start-form', ['id' => $form->id]);
    }

    public function mount()
    {
        $this->companies = Company::all();
    }

    public function render()
    {
        return view('livewire.submissions.index', [
            'forms' => Form::permisseble()
                ->where('record_number', 'like', '%'.$this->search.'%')
                ->with(['submitter', 'company'])
                ->latest()
                ->paginate(10),
        ]);
    }

    public function generateRecordNumber()
    {
        $initials = '';
        $words = explode(' ', auth()->user()->name);
        foreach ($words as $word) {
            $initials .= $word[0];
        }
        $submitionCount = Form::count();

        return now()->format('Ymd').'-'.$initials.'-'.str_pad($submitionCount + 1, 11, '0', STR_PAD_LEFT);
    }
}
