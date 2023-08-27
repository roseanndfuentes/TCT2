<?php

namespace App\Http\Livewire\RequestAccess;

use App\Models\ActivityLog;
use App\Services\PermissionsService;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    public $take = 10;
    public function render()
    {
        return view('livewire.request-access.index', [
            'task_logs' => ActivityLog::query()
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
