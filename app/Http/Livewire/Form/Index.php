<?php

namespace App\Http\Livewire\Form;

use App\Models\Form;
use App\Models\FormHistory;
use App\Models\PauseRemark;
use App\Models\TaskQuestion;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;

    public $pauseRemarkModal = false;

    public $pause_remark = '';

    public $form;

    public $formId;

    public $questions = [];

    public $persistedAnswers = [];

    public $statuses = Form::STATUSES;

    public $timeConverter;

    // form
    public $answersForm = [];

    public $initialInterview = 1;

    public $mode = '';

    public $queryString = ['mode'];

    public $changesHistory = [];

    public function mount($id)
    {
        $this->formId = $id;
        $this->form = Form::find($this->formId);
        $this->questions = TaskQuestion::where('task_id', $this->form->task_id)->get();

        $this->persistedAnswers = $this->form->answers;
        
        $this->initialInterview = $this->form->initial_review;

        $this->fillIntialForm($this->persistedAnswers);

        if($this->mode === 'traces'){
            $this->changesHistory = FormHistory::whereIn('answer_id',$this->persistedAnswers->pluck('id')->toArray())->get();
        }   
    }

    public function render()
    {

        return view('livewire.form.index',[
            'remarks'=>PauseRemark::where('form_id',$this->formId)->latest()->get()
        ]);
    }

    public function pause()
    {
        $this->validate([
            'pause_remark'=>'required'
        ]);
        // pause error message
    

        PauseRemark::create([
            'form_id'=>$this->formId,
            'remarks'=>$this->pause_remark,
        ]);

        $this->form->pause();

        $this->form->refresh();
        $this->notification()->success('Form paused successfully');

        $this->pauseRemarkModal = false;
    }

    public function resume()
    {
        if(!$this->canStillResume()){
            $this->dialog()->error(
                $title ="Action failed",
                $description = "You've still have on going task. Please submit before starting a new one."
            );
            return;
        }

        $this->form->resume();

        $this->form->refresh();
        $this->notification()->success('Form resumed successfully');
    }

    public function fillIntialForm()
    {
        foreach ($this->persistedAnswers as $answer) {
            $this->answersForm[$answer->question_id] = [
                'answer_id'=>$answer->id,
                'value'=>$answer->content,
            ];
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

    public function clickPauseHandler()
    {
        if(!$this->canStillPause()){
            $this->dialog()->error(
                $title ="Action failed",
                $description = "You've hit the limit for pausing tasks. Please finish or submit one task before pausing another."
            );
        return;
       }
       $this->pauseRemarkModal = true;
    }

    public function canStillPause()
    {
         $pauseFormsCount = Form::query()
                    ->where('submitted_by',auth()->user()->id)
                    ->where('status',Form::PAUSED)
                    ->count();
        return $pauseFormsCount < 2;
    }

    public function canStillResume()
    {
         $pauseFormsCount = Form::query()
                    ->where('submitted_by',auth()->user()->id)
                    ->where('status',Form::IN_PROGRESS)
                    ->count();
        return $pauseFormsCount === 0;
    }
    
}
