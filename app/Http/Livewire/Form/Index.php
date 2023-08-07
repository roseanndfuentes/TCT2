<?php

namespace App\Http\Livewire\Form;

use App\Models\Form;
use App\Models\TaskQuestion;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;

    public $form;

    public $formId;

    public $questions = [];

    public $persistedAnswers = [];

    public $statuses = Form::STATUSES;

    public $timeConverter;

    // form
    public $answersForm = [];

    public $initialInterview = 1;

    public function mount($id)
    {
        $this->formId = $id;
        $this->form = Form::find($this->formId);
        $this->questions = TaskQuestion::where('task_id', $this->form->task_id)->get();

        $this->persistedAnswers = $this->form->answers;
        
        $this->initialInterview = $this->form->initial_review;

        $this->fillIntialForm($this->persistedAnswers);
    }

    public function render()
    {

        return view('livewire.form.index');
    }

    public function pause()
    {
        $this->form->pause();

        $this->form->refresh();
        $this->notification()->success('Form paused successfully');
    }

    public function resume()
    {
        $this->form->resume();

        $this->form->refresh();
        $this->notification()->success('Form resumed successfully');
    }

    public function fillIntialForm()
    {
        foreach ($this->persistedAnswers as $answer) {
            $this->answersForm[$answer->question_id] = $answer->content;
        }
    }

    public function updatedInitialInterview()
    {
        $this->form->update([
            'initial_review' => $this->initialInterview == '1' ? true : false,
        ]);
    }

    public function updatedAnswersForm($value, $key)
    {
        $this->form->answers()->updateOrCreate([
            'question_id' => $key,
        ], [
            'content' => $value,
            'form_id' => $this->formId,
        ]);
    }

    public function submit()
    {

        foreach ($this->questions as $question) {
            if (! array_key_exists($question->id, $this->answersForm)) {
                $this->dialog()->error(
                    $title = 'Validation Error',
                    $description = 'Please fill all the questions',
                );

                return;
            } elseif (array_key_exists($question->id, $this->answersForm) && $this->answersForm[$question->id] == '') {
                $this->dialog()->error(
                    $title = 'Validation Error',
                    $description = 'Please fill all the questions',
                );

                return;
            }
        }

        $this->form->submit();

        $this->form->refresh();
        $this->notification()->success('Form submitted successfully');
    }
}
