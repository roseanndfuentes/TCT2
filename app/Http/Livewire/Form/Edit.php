<?php

namespace App\Http\Livewire\Form;

use App\Models\Form;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\ActivityLog;
use App\Models\FormHistory;
use App\Models\TaskQuestion;
use Illuminate\Support\Facades\DB;

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
                $newEntry = $this->form->answers()->updateOrCreate([
                    'question_id' => $key,
                ], [
                    'content' => $value,
                    'form_id' => $this->formId,
                ]);
                $oldData =  $this->persistedAnswers->find($newEntry->id);
                $contentHasBeenChange = $oldData->content !== $value;
                if($contentHasBeenChange){
                    $this->recordChangeHistory($newEntry->id,$oldData->content);
                }
        }
        // foreach ($this->answersForm as $key => $value) {
        //     $oldData =  $this->persistedAnswers->where('',$key);
        //     $contentHasBeenChange = $oldData->content !== $value;
        //     if($contentHasBeenChange){
        //         recordChangeHistory($oldData->id);
        //     }
        //     $this->form->answers()->updateOrCreate([
        //         'question_id' => $key,
        //     ], [
        //         'content' => $value,
        //         'form_id' => $this->formId,
        //     ]);
        // }

        ActivityLog::create([
            'user_id'=>auth()->user()->id,
            'action'=>'EDIT',
            'task_id'=>$this->form->record_number,
            'description'=>auth()->user()->name.' edited task : '.$this->form->record_number ,
            'form_id'=>$this->form->id,
        ]);

        $this->notification()->success('Form updated successfully');
    }

    function recordChangeHistory($answerId,$oldValue,$inputKey = 'Default'){
        FormHistory::create([
            'answer_id'=>$answerId,
            'old_data'=>$oldValue,
            'input_key'=>$inputKey,
        ]);
    }
}
