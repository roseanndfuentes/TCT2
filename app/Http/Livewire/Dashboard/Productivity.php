<?php

namespace App\Http\Livewire\Dashboard;


use App\Models\AdminProductivitySegment;
use App\Models\Holiday;
use App\Models\Segment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Productivity extends Component
{

	public $showAdminProductivityModal = false;

	public $selectedProductivitySegment = '';

	public $adminProductivitySegmentCollection = [];

	public $adminProductivitySegmentCollectionIds = [];

	public $oaasProductivityPercentage = 0;


	public $holidayTotalMinutes = 0;

	public $segmentList = [];

	public $selected = null;

	public $selected_id = null;

	public $submittedForms = [];

	public $weekStart = '';

	public $weekEnd = '';

	public $weekNo = '';

	public $totalTimeSpentInMins = 0;

	public $totalMinsInAWeek = 2250;

	public $adminProductivityPercentage = 0;

	public $totalLeave = 0;


	protected $queryString = [
		'selected_id' => ['except' => '', 'as' => 'q'],
		'weekStart' => ['except' => '', 'as' => 'ws'],
		'weekEnd' => ['except' => '', 'as' => 'we'],
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

	public function getSubmittedForms()
	{
		if ($this->selected) {
			$this->adminProductivitySegmentCollectionIds = AdminProductivitySegment::query()
				->where('user_id', $this->selected->id)->pluck('segment_id')->toArray();
			$this->submittedForms = DB::table('forms')
				->when($this->weekStart && $this->weekEnd, function ($query) {
					$query->whereDate('forms.created_at', '>=', $this->weekStart)
						->whereDate('forms.created_at', '<=', $this->weekEnd);
				})
				->where('forms.submitted_by', $this->selected->id)
				->get();


			$totalLeaveInMins = $this->selected->leaves()->whereDate('created_at', '>=', $this->weekStart)
				->whereDate('created_at', '<=', $this->weekEnd)->sum('computed_minutes');
			$this->totalLeave = $totalLeaveInMins;
			$this->holidayTotalMinutes = Holiday::query()
				->where('date_start', '>=', $this->weekStart)
				->where('date_end', '<=', $this->weekEnd)
				->get()
				->sum('computed_minutes');

			$this->totalTimeSpentInMins = $this->totalMinsInAWeek - $totalLeaveInMins - $this->holidayTotalMinutes;
			$this->adminProductivityPercentage = $this->submittedForms->whereIn('segment_id', $this->adminProductivitySegmentCollectionIds)
				->sum('total_time_spent') / $this->totalTimeSpentInMins;

			$this->oaasProductivityPercentage = $this->submittedForms->whereNotIn('segment_id', $this->adminProductivitySegmentCollectionIds)
				->sum('total_time_spent') / $this->totalTimeSpentInMins;
		}
	}

	public function saveSegment()
	{
		$this->validate([
			'selectedProductivitySegment' => 'required'
		]);

		AdminProductivitySegment::create([
			'segment_id' => $this->selectedProductivitySegment,
			'user_id' => $this->selected->id
		]);

		$this->showAdminProductivityModal = false;
	}

	public function deleteSegment($id)
	{
		AdminProductivitySegment::where('segment_id', $id)->where('user_id', $this->selected->id)->delete();
	}


	public function render()
	{
		return view('livewire.dashboard.productivity');
	}
}
