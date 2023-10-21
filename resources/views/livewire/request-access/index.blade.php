<div class="flex flex-col space-y-3">
    <div class="flex space-x-2 items-center">
        <x-input wire:model.debounce.500ms="search" type="search" icon="search" />
        <x-input type="date" wire:model="dateFilter" format="YYYY-MM" />
    </div>
    <table class="min-w-full bg-white border rounded-lg">
        <thead>
            <thead>
                <td colspan="2" class="py-2 px-4 font-bold text-indigo-700 border border-gray-200">
                    Task Activity Logs
                </td>
            </thead>
        </thead>
        <tbody x-animate>
            @forelse ($task_logs as $log)
                <tr wire:key="{{ $log->id }}">
                    <td class="py-4 px-4  text-gray-700 border border-gray-200">
                        <div class="flex space-x-2 items-center">
                            <x-button sm warning href="/submissions/form/{{ $log->form_id }}/starter?mode=traces" flat
                                icon="eye" label="View Task" />
                            <span class="text-gray-200 ">|</span>
                            <div class="pl-3 flex flex-col">
                                <div class="mb-1 flex items-center space-x-1">
                                    @if ($log->action === 'EDIT')
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </span>
                                    @endif
                                    <span>
                                        {{ $log->user->name }}
                                        @if ($log->action === 'EDIT')
                                            has <span class="text-yellow-500 font-bold">edited</span> the task : <span
                                                class="text-gray-500 font-bold">{{ $log->task_id }}</span>
                                        @endif
                                    </span>
                                </div>
                                <span class="text-gray-400 text-sm">
                                    {{ $log->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="py-4 px-4  text-gray-700 border border-gray-200">
                        <div class="flex justify-center">
                            <span class="text-gray-400 ">
                                No Logs Found
                            </span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="w-full mb-10 flex justify-center mt-5">
        <x-button wire:click="loadMore" white>
            Load More
        </x-button>
    </div>
</div>
