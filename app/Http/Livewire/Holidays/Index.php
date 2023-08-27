<?php

namespace App\Http\Livewire\Holidays;

use App\Models\Holiday;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;

    public $showCreateModal = false;

    public $showEditModal = false;

    public $createForm = [
        'name' => '',
        'date_start' => '',
        'date_end' => '',
    ];

    public $editForm = [
        'name' => '',
        'date_start' => '',
        'date_end' => '',
    ];

    public $editable = null;

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
            'computed_minutes' => $this->createForm['date_end'] == '' ? 450 : $this->getComputedMinutes(number_format($diff->format('%a') + 1)),
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

    public function edit($id)
    {
        $this->editable = Holiday::findOrFail($id);

        $this->editForm['name'] =  $this->editable->name;
        $this->editForm['date_start'] =  Carbon::parse($this->editable->date_start)->format('Y-m-d');
        $this->editForm['date_end'] =  Carbon::parse($this->editable->date_end)->format('Y-m-d');

        $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'editForm.name' => 'required',
            'editForm.date_start' => 'required',
            'editForm.date_end' => 'nullable|after_or_equal:editForm.date_start',
        ], [], [
            'editForm.name' => 'Name',
            'editForm.date_start' => 'Date Start',
            'editForm.date_end' => 'Date End',
        ]);

        $dto = [
            'name' => $this->editForm['name'],
            'date_start' => $this->editForm['date_start'].' 00:00:00',
            'date_end' => $this->editForm['date_end'].' 23:59:59',
        ];

        // get number of days between two dates
        $date1 = date_create($dto['date_start']);
        $date2 = date_create($dto['date_end']);
        $diff = date_diff($date1, $date2);

        $this->editable->update([
            'name' => $dto['name'],
            'date_start' => $dto['date_start'],
            'date_end' => $this->editForm['date_end'] == '' ? $dto['date_start'] : $dto['date_end'],
            'computed_minutes' => $this->editForm['date_end'] == '' ? 450 : $this->getComputedMinutes(number_format($diff->format('%a') + 1)),
        ]);

        $this->showEditModal = false;
        $this->editForm = [
            'name' => '',
            'date_start' => '',
            'date_end' => '',
        ];

        $this->notification()->success('Holiday updated successfully.');

        $this->dispatchBrowserEvent('new-holiday-added');
    }

    public function getComputedMinutes($noOfDays)
    {
        $computedMinutes = $noOfDays * 450;

        return $computedMinutes;
    }

    public function delete()
    {
        $this->editable->delete();

        $this->showEditModal = false;

        $this->notification()->success('Holiday deleted successfully.');

        $this->dispatchBrowserEvent('new-holiday-added');
    }

    public function render()
    {
        return view('livewire.holidays.index');
    }
}
