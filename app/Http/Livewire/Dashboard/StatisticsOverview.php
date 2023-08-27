<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Form;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatisticsOverview extends Component
{
    public function getOtherStats()
    {
        $companiesQuery = DB::table('companies')->select([
            DB::raw('"total_companies" as label'),
            DB::raw('count(*) as value'),
        ]);

        $usersQuery = DB::table('users')->select([
            DB::raw('"total_users" as label'),
            DB::raw('count(*) as value'),
        ]);

        return $companiesQuery->union($usersQuery)->get()
            ->mapWithKeys(function ($item) {
                return [$item->label => $item->value];
            });
    }

    public function render()
    {
        return view('livewire.dashboard.statistics-overview', [
            'formReport' => DB::table('forms')
                ->selectRaw('count(*) as total')
                ->selectRaw("count(case when status = 'submitted' then 1 end) as submitted")
                ->selectRaw("count(case when status = 'paused' then 1 end) as paused")
                ->selectRaw("count(case when status = 'in_progress' then 1 end) as in_progress")
                ->first(),
            'otherStats' => $this->getOtherStats(),
            'getTotalMinsToday'=>Form::whereDate('submitted_at', Carbon::today())->sum('total_time_spent'),
        ]);
    }
}
