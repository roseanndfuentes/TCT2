<?php

namespace App\Http\Livewire\Charts;

use App\Models\Form;
use Livewire\Component;

class LastSevenDayChart extends Component
{
    public $startDate;

    public $endDate;

    public $chartValues = [];

    public $labels = [];

    public function mount()
    {
        $carbon = new \Carbon\Carbon();
        $this->labels = [
            $carbon->now()->subDays(6)->format('Y-m-d'),
            $carbon->now()->subDays(5)->format('Y-m-d'),
            $carbon->now()->subDays(4)->format('Y-m-d'),
            $carbon->now()->subDays(3)->format('Y-m-d'),
            $carbon->now()->subDays(2)->format('Y-m-d'),
            $carbon->now()->subDays(1)->format('Y-m-d'),
            $carbon->now()->format('Y-m-d'),
        ];

        $this->loadData();
    }

    public function generateDateList()
    {
        if ($this->startDate && $this->endDate) {
            $this->labels = [];
            $startDate = \Carbon\Carbon::parse($this->startDate);
            $endDate = \Carbon\Carbon::parse($this->endDate);
            $this->labels[] = $startDate->format('Y-m-d');
            while ($startDate->lt($endDate)) {
                $startDate->addDay();
                $this->labels[] = $startDate->format('Y-m-d');
            }

            $this->emit('updateChart');
        }
    }

    public function loadData()
    {
        $this->chartValues = [];
        $submissions = Form::query()
            ->selectRaw('count(*) as count, DATE(submitted_at) as date')
            ->where('status', Form::SUBMITTED)
            ->whereDate('submitted_at', '>=', $this->labels[0])
            ->whereDate('submitted_at', '<=', $this->labels[count($this->labels) - 1])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('count', 'date')
            ->toArray();
        foreach ($this->labels as $label) {
            $this->chartValues[] = $submissions[$label] ?? 0;
        }
    }

    public function render()
    {
        $this->generateDateList();
        if ($this->startDate && $this->endDate) {
            $this->loadData();
        }

        return view('livewire.charts.last-seven-day-chart');
    }
}
