<div>
    @if ($company)
        <div x-data class="space-y-4">
            <h1 class="text-2xl font-semibold text-indigo-600">
                {{ $company->name }}
            </h1>
            <div class="flex justify-between">
                <div class="space-x-3 flex items-center">
                    <div>
                        <x-select-input class="w-80" wire:model="s_id">
                            <option value="" hidden>
                                --Select Segment--
                            </option>
                            <option value="">
                                Select All
                            </option>
                            @foreach ($segments as $segment)
                                <option value="{{ $segment->id }}">{{ $segment->name }}</option>
                            @endforeach
                        </x-select-input>
                    </div>
                    <div id="edit-segment-button">
                        @if ($s_id)
                            <x-secondary-button wire:click="editSegment">
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </x-slot:icon>
                                <span class="ml-2">Edit Segment</span>
                            </x-secondary-button>
                        @endif
                    </div>
                    <div id="edit-segment-button">
                        @if ($s_id)
                            <x-danger-button
                                x-on:confirm="{
                                title:'Delete Segment',
                                description : 'Are you sure you want to delete this record. Please update the task with in this segments ',
                                method:'deleteSegment',
                                params : '{{ $s_id }}',
                            }">
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </x-slot:icon>
                                <span class="ml-2">Delete Segment</span>
                            </x-danger-button>
                        @endif
                    </div>
                </div>
                <div class="flex space-x-2 items-center">
                    <div id="segment-btn-create">
                        <x-secondary-button x-on:click="$openModal('showCreateSegmentModal')">
                            <x-slot:icon>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                            </x-slot:icon>
                            <span class="ml-2">Add Segment</span>
                        </x-secondary-button>
                    </div>
                    <div id="task-btn-create">
                        @if ($s_id)
                            <x-primary-button x-on:click="$openModal('showCreateTaskModal')">
                                <x-slot:icon>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                </x-slot:icon>
                                <span class="ml-2">Add Task</span>
                            </x-primary-button>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                @include('includes.datatables._tasks')
            </div>

            <div>
                @include('includes.modals._segment-create')
            </div>

            <div>
                @include('includes.modals._segment-edit')
            </div>

            <div>
                @include('includes.modals._task-create')
            </div>

            <div>
                @include('includes.modals._task-edit')
            </div>
            <div>
                @include('includes.modals._task-show')
            </div>
        </div>
    @else
        @include('includes.partials._select-company-dropdown')
    @endif
</div>
