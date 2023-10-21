<?php

namespace App\Http\Livewire\RequestAccess;

use App\Models\ActivityLog;
use App\Services\PermissionsService;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    public $take = 10;

    public $search = '';
    public $dateFilter = '';
    public function render()
    {
        return view('livewire.request-access.index', [
            'task_logs' => ActivityLog::query()
                    ->when($this->search!=='',function($query){
                        $query->where('task_id','like','%'.$this->search.'%');
                    })
                    ->when($this->dateFilter!=='',function($query){
                        $query->whereDate('created_at',date($this->dateFilter));
                    })
                    ->with('user')
                    ->latest()
                    ->get()->take($this->take)
        ]);
    }

    public function loadMore()
    {
        $this->take  = $this->take + 10;
    }
}
