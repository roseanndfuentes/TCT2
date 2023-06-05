<div x-data class="space-y-4">
    <div class="flex justify-between">
        <x-text-input wire:model.debounce.500ms="search" type="search" placeholder="Search" class="w-80" />
        <div class="flex space-x-2 items-center">
            <x-primary-button x-on:click="$openModal('showCreateModal')">
                <x-slot:icon>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>
                </x-slot:icon>
                <span class="ml-2">Add Role</span>
            </x-primary-button>
        </div>
    </div>
    <div>
        @include('includes.datatables._roles')
    </div>

    <div>
        @include('includes.modals._role-create')
    </div>
    <div>
        @include('includes.modals._role-edit')
    </div>
</div>
