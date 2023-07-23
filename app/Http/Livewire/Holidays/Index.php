<?php

namespace App\Http\Livewire\Holidays;

use App\Models\Holiday;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;

    public $showCreateModal = false;

    public $createForm = [
        'name' => '',
        'date_start' => '',
        'date_end' => '',
    ];

    public function create($startDate)
    {
        $this->createForm['name'] = '';
        $this->createForm['date_end'] = '';
        $this->createForm['date_start'] = $startDate;
        $this->showCreateModal = true;
    }

    public function store()
    {
        $this->validate([
            'createForm.name' => 'required',
            'createForm.date_start' => 'required',
            'createForm.date_end' => 'nullable|after_or_equal:createForm.date_start',
        ], [], [
            'createForm.name' => 'Name',
            'createForm.date_start' => 'Date Start',
            'createForm.date_end' => 'Date End',
        ]);

        $dto = [
            'name' => $this->createForm['name'],
            'date_start' => $this->createForm['date_start'].' 00:00:00',
            'date_end' => $this->createForm['date_end'].' 23:59:59',
        ];

        // get number of days between two dates
        $date1 = date_create($dto['date_start']);
        $date2 = date_create($dto['date_end']);
        $diff = date_diff($date1, $date2);

        $holiday = Holiday::create([
            'name' => $dto['name'],
            'date_start' => $dto['date_start'],
            'date_end' => $this->createForm['date_end'] == '' ? $dto['date_start'] : $dto['date_end'],
            'computed_minutes' => $this->createForm['date_end'] == '' ? 480 : $this->getComputedMinutes(number_format($diff->format('%a') + 1)),
        ]);

        $this->showCreateModal = false;
        $this->createForm = [
            'name' => '',
            'date_start' => '',
            'date_end' => '',
        ];

        $this->notification()->success('Holiday created successfully.');

        $this->dispatchBrowserEvent('new-holiday-added');
    }

    public function getComputedMinutes($noOfDays)
    {
        $computedMinutes = $noOfDays * 480;

        return $computedMinutes;
    }

    public function render()
    {
        return view('livewire.holidays.index');
    }
}
