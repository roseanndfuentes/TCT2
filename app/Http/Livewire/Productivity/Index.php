<?php

namespace App\Http\Livewire\Productivity;

use App\Models\Holiday;
use App\Models\Segment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $holidayTotalMinutes = 0;

    public $segmentList = [];

    public $selected = null;

    public $selected_id = null;

    public $submittedForms = [];

    public $weekStart = '';

    public $weekEnd = '';

    public $weekNo = '';

    public $totalTimeSpentInMins = 0;

    public $tatalMinsInAWeek = 2400;

    protected $queryString = [
        'selected_id' => ['except' => '', 'as' => 'q'],
    ];

    public function selectUser($id)
    {
        $this->selected = User::find($id);
        $this->selected_id = $id;
    }

    public function mount()
    {
        $this->segmentList = Segment::with('company')->get();

        $this->weekStart = now()->startOfWeek()->format('Y-m-d');
        $this->weekEnd = now()->endOfWeek()->format('Y-m-d');

        $this->weekNo = now()->weekOfYear;

        if ($this->selected_id) {
            $this->selected = User::find($this->selected_id);
        }
    }

    public function render()
    {
        $this->getSubmittedForms();

        return view('livewire.productivity.index');
    }

    public function getSubmittedForms()
    {
        if ($this->selected) {
            $this->submittedForms = DB::table('forms')
                ->when($this->weekStart && $this->weekEnd, function ($query) {
                    $query->whereDate('forms.created_at', '>=', $this->weekStart)
                        ->whereDate('forms.created_at', '<=', $this->weekEnd);
                })
                ->where('forms.submitted_by', $this->selected->id)
                ->get();

            $totalLeaveInMins = $this->selected->leaves->sum('computed_minutes');

            $this->holidayTotalMinutes = Holiday::query()
                ->where('date_start', '>=', $this->weekStart)
                ->where('date_end', '<=', $this->weekEnd)
                ->get()
                ->sum('computed_minutes');
                
            $this->totalTimeSpentInMins = $this->tatalMinsInAWeek - $totalLeaveInMins - $this->holidayTotalMinutes;

        }
    }
}
