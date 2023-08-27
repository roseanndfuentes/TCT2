<?php

namespace App\Http\Livewire\Approvals;

use App\Models\Approval;
use App\Models\Form;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.approvals.index',[
            'approvals'=> Approval::query()
                    ->paginate(10),
        ]);
    }
}
