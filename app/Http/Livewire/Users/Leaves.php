<?php

namespace App\Http\Livewire\Users;

use App\Models\Leave;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Leaves extends Component
{
    use Actions , WithPagination;

    public $user = null;

    public $showCreateModal = false;

    public $showEditModal = false;

    public $editable = null;

    public $dateFilter = '';

    public $createForm = [
        'type' => '',
        'shift_type' => '',
        'reason' => '',
        'computed_minutes' => '',
        'work_week' => '',
        'year' => '',
    ];

    public $editForm = [
        'type' => '',
        'shift_type' => '',
        'reason' => '',
        'computed_minutes' => '',
        'work_week' => '',
        'year' => '',
    ];

    public $leaveTypes = Leave::TYPES;

    public $shiftTypes = Leave::SHIFT;

    public function store()
    {
        $this->validate([
            'createForm.type' => 'required',
            'createForm.shift_type' => 'required',
            'createForm.reason' => 'required',
            'createForm.computed_minutes' => 'required',
            'createForm.work_week' => 'required',
            'createForm.year' => 'required',
        ], [], [
            'createForm.type' => 'Type',
            'createForm.shift_type' => 'Shift Type',
            'createForm.reason' => 'Reason',
            'createForm.computed_minutes' => 'Computed Minutes',
            'createForm.work_week' => 'Work Week',
            'createForm.year' => 'Date',
        ]);

        $this->user->leaves()->create($this->createForm);

        $this->notification()->success('Leave created successfully');

        $this->showCreateModal = false;

        $this->user->refresh();
    }

    public function updatedCreateFormShiftType($value)
    {
        if ($value == 'FULL_SHIFT') {
            $this->createForm['computed_minutes'] = 480;
        } else {
            $this->createForm['computed_minutes'] = 240;
        }
    }

    public function updatedCreateFormYear()
    {
        $this->createForm['work_week'] = date('W', strtotime($this->createForm['year']));
    }

    public function edit($id)
    {
        $this->editable = Leave::find($id);

        $this->editForm = $this->editable->toArray();

        $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'editForm.type' => 'required',
            'editForm.shift_type' => 'required',
            'editForm.reason' => 'required',
            'editForm.computed_minutes' => 'required',
            'editForm.work_week' => 'required',
            'editForm.year' => 'required',
        ], [], [
            'editForm.type' => 'Type',
            'editForm.shift_type' => 'Shift Type',
            'editForm.reason' => 'Reason',
            'editForm.computed_minutes' => 'Computed Minutes',
            'editForm.work_week' => 'Work Week',
            'editForm.year' => 'Date',
        ]);

        $this->editable->update($this->editForm);

        $this->notification()->success('Leave updated successfully');

        $this->showEditModal = false;

        $this->user->refresh();
    }

    public function delete($id)
    {
        $leave = Leave::find($id);

        $leave->delete();

        $this->notification()->success('Leave deleted successfully');

        $this->user->refresh();
    }

    public function mount($id)
    {
        $this->user = User::find($id);

    }

    public function render()
    {

        return view('livewire.users.leaves', [
            'leaves' => $this->user->leaves()
                ->when($this->dateFilter != '', function ($query) {
                    $query->where('year', $this->dateFilter);
                })
                ->paginate(10),
        ]);
    }
}
