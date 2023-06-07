<div>
    @if ($company)
        <div x-data class="space-y-4">
            <h1 class="text-2xl font-semibold text-indigo-600">
                {{ $company->name }}
            </h1>
            <div class="flex justify-between">
                <x-select-input class="w-80" wire:model="s_id">
                    <option value="" hidden>
                        --Select Segment--
                    </option>
                    @foreach ($segments as $segment)
                        <option value="{{ $segment->id }}">{{ $segment->name }}</option>
                    @endforeach
                </x-select-input>
                <div class="flex space-x-2 items-center">
                    <x-secondary-button x-on:click="$openModal('showCreateSegmentModal')">
                        <x-slot:icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                        </x-slot:icon>
                        <span class="ml-2">Add Segment</span>
                    </x-secondary-button>
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
            <div>
                @include('includes.datatables._tasks')
            </div>

            <div>
                @include('includes.modals._segment-create')
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
