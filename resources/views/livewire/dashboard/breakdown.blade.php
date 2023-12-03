<div class="py-2 flex flex-col gap-4">
    <div class="flex justify-between items-center space-x-2">
        <div>

        </div>
        <div class="flex  items-center space-x-2">
            <x-input label="Week Start" wire:model="weekStart" type="date" />
            <x-input label="Week End" wire:model="weekEnd" type="date" />
        </div>
    </div>
    <x-tct.table :headers="[
        'User',
        'Total Productivity Percentage',
        'OAAS Productivity Percentage',
        'Admin Productivity Percentage',
    ]">
        @forelse ($users as $user)
            @php
                $userTotalLeaveInMins = $totalLeaveInMins->where('user_id', $user->id)->sum('computed_minutes');
                $totalTimeSpentInMins = $totalMinsInAWeek - $userTotalLeaveInMins - $holidayTotalMinutes;
                $adminProductivityPercentage =
                    $submittedForms
                        ->where('submitted_by', $user->id)
                        ->whereIn('segment_id', $adminProductivitySegmentCollectionIds)
                        ->sum('total_time_spent') / $totalTimeSpentInMins;

                $oaasProductivityPercentage =
                    $submittedForms
                        ->where('submitted_by', $user->id)
                        ->whereNotIn('segment_id', $adminProductivitySegmentCollectionIds)
                        ->sum('total_time_spent') / $totalTimeSpentInMins;
            @endphp
            <tr>
                <x-tct.tcell>
                    {{ $user->name }}
                </x-tct.tcell>
                <x-tct.tcell>
                    {{ number_format($oaasProductivityPercentage + $adminProductivityPercentage, 2) }} %
                </x-tct.tcell>
                <x-tct.tcell>
                    {{ number_format($oaasProductivityPercentage, 2) }} %
                </x-tct.tcell>
                <x-tct.tcell>
                    {{ number_format($adminProductivityPercentage, 2) }} %
                </x-tct.tcell>
            </tr>
        @empty
            <tr>
                <x-tct.empty-table colspan="4" />
            </tr>
        @endforelse
    </x-tct.table>
    @php
        $segmentHeaders = $segmentList->pluck('name')->toArray();
    @endphp
    <x-tct.table :headers="['User', ...$segmentHeaders]">
        @forelse ($users as $user)
            <tr>
                <x-tct.tcell>
                    {{ $user->name }}
                </x-tct.tcell>
                @foreach ($segmentList as $item)
                    <x-tct.tcell>
                        @php
                            $totalSubmittedOnThidSegment = collect($submittedForms)
                                ->where('submitted_by', $user->id)
                                ->where('segment_id', $item->id)
                                ->sum('total_time_spent');
                        @endphp
                        {{ number_format($totalSubmittedOnThidSegment / 60, 2) }} mins
                    </x-tct.tcell>
                @endforeach
            </tr>
        @empty
            <tr>
                <x-tct.empty-table colspan="{{ count($segmentHeaders) + 1 }}" />
            </tr>
        @endforelse
    </x-tct.table>

    @php
        $holidayLabel = 'Holidays total Mins : ' . $holidayTotalMinutes . ' mins';
    @endphp
    <x-tct.table :headers="['User', $holidayLabel, 'Leave']">
        @forelse ($users as $user)
            <tr>
                <x-tct.tcell>
                    {{ $user->name }}
                </x-tct.tcell>
                <x-tct.tcell>
                    -----------------
                </x-tct.tcell>
                <x-tct.tcell>
                    {{ number_format($totalLeaveInMins->where('user_id', $user->id)->sum('computed_minutes') / 60, 2) }}
                    mins
                </x-tct.tcell>
            </tr>
        @empty
            <tr>
                <x-tct.empty-table colspan="3" />
            </tr>
        @endforelse
    </x-tct.table>
</div>
