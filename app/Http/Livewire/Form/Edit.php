<?php

namespace App\Http\Livewire\Form;

use App\Models\Form;
use Livewire\Component;
use App\Models\TaskQuestion;
use WireUi\Traits\Actions;
class Edit extends Component
{
    use Actions;

    public $form;

    public $formId;

    public $questions = [];

    public $statuses = Form::STATUSES;

    public $timeConverter;

    // form

    public $persistedAnswers = [];

    public $answersForm = [];

    public function fillIntialForm()
    {
        foreach ($this->persistedAnswers as $answer) {
            $this->answersForm[$answer->question_id] = $answer->content;
        }
    }

    public function mount($id)
    {
        $this->formId = $id;
        $this->form = Form::find($this->formId);
        $this->questions = TaskQuestion::where('task_id', $this->form->task_id)->get();
        $this->persistedAnswers = $this->form->answers;
        $this->fillIntialForm($this->persistedAnswers);
    }

    // public function updatedAnswersForm($value, $key)
    // {
    //     $this->form->answers()->updateOrCreate([
    //         'question_id' => $key,
    //     ], [
    //         'content' => $value,
    //         'form_id' => $this->formId,
    //     ]);
    // }

    public function render()
    {
        return view('livewire.form.edit');
    }
    public function update()
    {

        if(!auth()->user()->can('edit form')) {
            $this->dialog()->error('You are not authorized to update this form');
            return;
        }

        foreach ($this->answersForm as $key => $value) {
            $this->form->answers()->updateOrCreate([
                'question_id' => $key,
            ], [
                'content' => $value,
                'form_id' => $this->formId,
            ]);
        }

        $this->notification()->success('Form updated successfully');
    }
}
