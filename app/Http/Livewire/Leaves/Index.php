<?php

namespace App\Http\Livewire\Leaves;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.leaves.index', [
            'users' => User::query()
                ->withCount('leaves')
                ->paginate(10),
        ]);
    }
}
