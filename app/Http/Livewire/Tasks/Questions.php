<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use App\Models\TaskQuestion;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Questions extends Component
{
    use WithPagination, Actions;

    public $task;

    // filters
    public $search = '';

    public $queryString = [
        'search' => ['except' => ''],
    ];

    // models and collections
    public $editable = null;

    // modals
    public $showCreateModal = false;

    public $showEditModal = false;

    // forms
    public $createForm = [
        'question' => '',
        'options' => '',
    ];

    public $editForm = [
        'question' => '',
        'options' => '',
    ];

    public function store()
    {
        if (auth()->user()->cannot('create company questions')) {
            $this->notification()->error('You are not authorized to create company');

            return;
        }
        $this->validate([
            'createForm.question' => 'required|string',
            'createForm.options' => 'nullable|string',
        ], [], [
            'createForm.question' => 'question',
            'createForm.options' => 'options',
        ]);

        TaskQuestion::create([
            'task_id' => $this->task->id,
            'message' => $this->createForm['question'],
            'options' => $this->createForm['options'],
            'input_type' => $this->createForm['options'] ? 'select' : 'text',
            'created_by' => auth()->user()->id,
        ]);

        $this->notification()->success('Question created successfully');
        $this->showCreateModal = false;
        $this->createForm = [
            'question' => '',
            'options' => '',
        ];
    }

    public function edit($id)
    {
        if (auth()->user()->cannot('edit company questions')) {
            $this->notification()->error('You are not authorized to edit company');

            return;
        }
        $this->editable = TaskQuestion::find($id);
        $this->editForm = [
            'question' => $this->editable->message,
            'options' => $this->editable->options,
        ];
        $this->showEditModal = true;
    }

    public function update()
    {
        if (auth()->user()->cannot('edit company questions')) {
            $this->notification()->error('You are not authorized to update company');

            return;
        }
        $this->validate([
            'editForm.question' => 'required|string',
            'editForm.options' => 'nullable|string',
        ], [], [
            'editForm.question' => 'question',
            'editForm.options' => 'options',
        ]);

        $this->editable->update([
            'message' => $this->editForm['question'],
            'options' => $this->editForm['options'],
            'input_type' => $this->editForm['options'] ? 'select' : 'text',
        ]);

        $this->notification()->success('Question updated successfully');
        $this->showEditModal = false;
        $this->editForm = [
            'question' => '',
            'options' => '',
        ];
    }

    public function mount($id)
    {
        $this->task = Task::find($id);
    }

    public function render()
    {
        return view('livewire.tasks.questions', [
            'questions' => $this->task->taskQuestions()
                ->when($this->search != '', function ($query) {
                    $query->where('message', 'like', '%'.$this->search.'%');
                })
                ->with('creator')
                ->paginate(10),
        ]);

    }
}
