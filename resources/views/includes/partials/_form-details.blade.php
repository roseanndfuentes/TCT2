<div>
    <table class="min-w-full bg-white border rounded-lg">
        <thead>
            <thead>
                <td colspan="4" class="py-2 px-4 font-bold text-indigo-700 border border-gray-200">
                    Details
                </td>
            </thead>
        </thead>
        <tbody>
            <tr>
                <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                    Company
                </td>
                <td class="py-2 px-4 text-gray-500 border border-gray-200">
                    {{ $form->company->name }}
                </td>
                <td class="py-2  px-4 font-bold text-gray-700 border border-gray-200">
                    Start Time
                </td>
                <td class="py-2 px-4  text-gray-500 border border-gray-200">
                    {{ date('d-m-Y H:i:s', strtotime($form->start_time)) }}
                </td>
            </tr>
            <tr>
                <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                    Segment
                </td>
                <td class="py-2 px-4  text-gray-500 border border-gray-200">
                    {{ $form->segment->name }}
                </td>
                <td class="py-2 font-bold text-gray-700  px-4 border border-gray-200">
                    Status
                </td>
                <td class="py-2 px-4  text-gray-500 border border-gray-200">
                    {{ $statuses[$form->status] }}
                </td>
            </tr>
            <tr>
                <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                    Task
                </td>
                <td class="py-2 px-4  text-gray-500 border border-gray-200">
                    {{ $form->task->name }}
                </td>
                <td class="py-2 px-4 font-bold text-gray-700  border border-gray-200">
                    {{ $form->isSubmitted() ? 'Total time spend' : 'Timer' }}
                </td>
                <td class="py-2 px-4  text-gray-500 border border-gray-200">
                    @if ($form->isInProgress())
                        @php
                            $start = null;
                            
                            if ($form->total_time_spent) {
                                $start = \App\Services\TimeConverter::secToTime($form->total_time_spent + \Carbon\Carbon::parse($form->last_resume_time)->diffInSeconds(\Carbon\Carbon::now()));
                            } else {
                                $start = \Carbon\Carbon::parse($form->start_time)
                                    ->diff(\Carbon\Carbon::now())
                                    ->format('%H:%I:%S');
                            }
                        @endphp
                        <x-count-up start="{{ $start }}" />
                    @else
                        <span>
                            {{ \App\Services\TimeConverter::secToTime($form->total_time_spent) }}
                        </span>
                    @endif
                </td>
            </tr>
            <tr wire:key="pause-remarks-3214809238049ojr2u43023984er23hruio">
                <td colspan="4" class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                    Pause Remarks
                </td>
            </tr>
            @forelse ($remarks as $remark)
                <tr>
                    <td colspan="4" class="py-2 px-4  text-gray-500 border border-gray-200">
                        <p>
                            ({{ $remark->created_at->diffForHumans() }})
                            <span class="text-gray-700 font-semibold">{{ $remark->remarks }}</span>
                        </p>
                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>
