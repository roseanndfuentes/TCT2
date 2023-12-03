<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\AdminProductivitySegment;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\Segment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class Breakdown extends Component
{

	public $users = [];

	public $weekStart = '';

	public $weekEnd = '';

	public $weekNo = '';

	public $selectedIds = [];
	public $totalLeaveInMins = [];
	public $segmentList = [];
	public $submittedForms = [];
	public $adminProductivitySegmentCollectionIds = [];
	
	public $holidayTotalMinutes = [];
	public $totalTimeSpentInMins  = 0;

	public $totalMinsInAWeek = 2250;

	public function mount()
	{
		$this->segmentList = Segment::with('company')->get();
		$this->users = User::whereHas('submitted_forms')->get();
		$this->selectedIds =  $this->users->pluck('id')->toArray();
	}

	public function getSubmittedForms()
	{
		if (count($this->selectedIds)>0) {
			$this->adminProductivitySegmentCollectionIds = AdminProductivitySegment::query()
			->whereIn('user_id', $this->selectedIds)->pluck('segment_id')->toArray();
		$this->submittedForms = DB::table('forms')
			->when($this->weekStart && $this->weekEnd, function ($query) {
				$query->whereDate('forms.created_at', '>=', $this->weekStart)
					->whereDate('forms.created_at', '<=', $this->weekEnd);
			})
			->whereIn('forms.submitted_by',  $this->selectedIds)
			->get();


		$this->totalLeaveInMins = Leave::whereIn('user_id',$this->selectedIds)->whereDate('created_at', '>=', $this->weekStart)
			->whereDate('created_at', '<=', $this->weekEnd)->get();
		// $this->totalLeave = $totalLeaveInMins;
		$this->holidayTotalMinutes = Holiday::query()
			->where('date_start', '>=', $this->weekStart)
			->where('date_end', '<=', $this->weekEnd)
			->get()
			->sum('computed_minutes');
		}
	}

    public function render()
    {
		$this->getSubmittedForms();
        return view('livewire.dashboard.breakdown');
    }
}
