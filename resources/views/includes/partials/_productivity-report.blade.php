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
        {{-- <td colspan="2" class="py-3 px-4  border border-gray-200 border-b-indigo-600">
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
        </td> --}}
        <x-tct.productivity-row wire:key="total-productivity-percentage" label="TOTAL PRODUCTIVITY PERCENTAGE"
            value="{{ number_format($oaasProductivityPercentage + $adminProductivityPercentage, 2) }} %" />
        <x-tct.productivity-row wire:key="oaas-productivity-percentage" label="OAAS PRODUCTIVITY PERCENTAGE"
            value="{{ number_format($oaasProductivityPercentage, 2) }} %" />
        <tr wire:key="admin-productivity-percentage" class="hover:bg-gray-100">
            <td class="py-2 px-4 text-gray-500 border border-gray-200">
                <div x-data="{ isOpen: false }">
                    <div class="w-full  grid space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="text-indigo-700 font-semibold">
                                ADMIN PRODUCTIVITY PERCENTAGE
                            </span>
                            <button x-on:click="isOpen=!isOpen">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    x-bind:class="{
                                        'rotate-180 duration-150': isOpen,
                                        'rotate-0 duration-150': !isOpen
                                    }"
                                    class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                        d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div x-cloak x-show="isOpen" x-collapse>
                        <button x-on:click="$wire.showAdminProductivityModal=true"
                            class="flex hover:text-green-600 group space-x-2 text-sm items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="group-hover:underline">Add New</span>
                        </button>
                        <ul class="px-4">
                            @foreach ($adminProductivitySegmentCollectionIds as $collection)
                                <li wire:key="{{ $collection }}" class="text-gray-500 flex  space-x-4 items-center">
                                    @php
                                        $segment = $segmentList->find($collection);
                                    @endphp
                                    <button wire:click="deleteSegment({{ $segment->id }})"
                                        class="text-sm text-red-500 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path fill-rule="evenodd"
                                                d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <span>{{ $segment->name }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </td>
            <td class="py-2 px-4 text-gray-500 border border-gray-200">
                <div class="w-full  grid space-y-2">
                    <div class="flex space-x-2">
                        <span class="text-indigo-700">
                            {{ number_format($adminProductivityPercentage, 2) }} %
                        </span>
                    </div>
                </div>
            </td>
        </tr>

        @foreach ($segmentList->whereNotIn('id', $adminProductivitySegmentCollectionIds) as $segment)
            @php
                $totalTimeSpent = $selected ? $submittedForms->where('segment_id', $segment->id)->sum('total_time_spent') : 0;
            @endphp
            <x-tct.productivity-row pre-label="Total Time Spent " wire:key="total-time-spent-{{ $segment->id }}"
                label="({{ $segment->company->name }}-{{ $segment->name }})" value="{{ $totalTimeSpent }} mins" />
        @endforeach
        <x-tct.productivity-row wire:key="holidays" label="Holidays" value="{{ $holidayTotalMinutes }} mins" />
        <x-tct.productivity-row wire:key="total-leave" label="Total Leave" value="{{ $totalLeave }} mins" />
        <x-tct.productivity-row wire:key="expected-total-time-spent" label="Expected Total Time Spent"
            value="{{ $totalTimeSpentInMins }} mins" />
    </tbody>
</table>
