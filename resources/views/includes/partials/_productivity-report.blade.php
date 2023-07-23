<table class="min-w-full bg-white border rounded-lg z-30" x-animate>
    @if ($selected)
        <thead wire:key="selected-user">
            <td colspan="2" class="py-3 px-4  border border-gray-200">
                <div class="flex space-x-3">
                    <div class="flex items-center space-x-3">
                        <span>Name : </span>
                        <span class="text-indigo-700 font-bold ">
                            {{ $selected->name }} ({{ $selected->email }})
                        </span>
                    </div>
                </div>
            </td>

        </thead>
    @endif
    <tbody>
        <td colspan="2" class="py-3 px-4  border border-gray-200 border-b-indigo-600">
            <div class="flex space-x-3">
                <div class="flex items-center space-x-5 ">
                    <div class="flex items-center space-x-1">
                        <span>Workweek Start : </span>
                        <input wire:model="weekStart" type="date"
                            class="font-semibold border-0 ring-0 focus:ring-0 focus:border-0" />
                    </div>
                    <div class="flex items-center space-x-1">
                        <span>Workweek End : </span>
                        <input wire:model="weekEnd" type="date"
                            class="font-semibold border-0 ring-0 focus:ring-0 focus:border-0" />
                    </div>
                    <div class="flex items-center space-x-1">
                        <span>Workweek No. : </span>
                        <span class="font-semibold border-0 ring-0 focus:ring-0 focus:border-0">
                            {{ $weekNo }}
                        </span>
                    </div>
                </div>
            </div>
        </td>
        <x-tct.productivity-row wire:key="total-productivity-percentage" label="TOTAL PRODUCTIVITY PERCENTAGE"
            value="%" />
        <x-tct.productivity-row wire:key="oaas-productivity-percentage" label="OAAS PRODUCTIVITY PERCENTAGE"
            value="%" />
        <x-tct.productivity-row wire:key="admin-productivity-percentage" label="ADMIN PRODUCTIVITY PERCENTAGE"
            value="%" />
        @foreach ($segmentList as $segment)
            @php
                $totalTimeSpent = $selected ? $submittedForms->where('segment_id', $segment->id)->sum('total_time_spent') : 0;
            @endphp
            <x-tct.productivity-row pre-label="Total Time Spent " wire:key="total-time-spent-{{ $segment->id }}"
                label="({{ $segment->company->name }}-{{ $segment->name }})" value="{{ $totalTimeSpent }} mins" />
        @endforeach
        <x-tct.productivity-row wire:key="holidays" label="Holidays" value="{{ $holidayTotalMinutes }} mins" />
        <x-tct.productivity-row wire:key="expected-total-time-spent" label="Expected Total Time Spent"
            value="{{ $totalTimeSpentInMins }} mins" />
    </tbody>
</table>
