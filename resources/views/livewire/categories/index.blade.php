<div x-data class="space-y-4">
    <div class="flex justify-between">
        <x-text-input wire:model.debounce.500ms="search" type="search" placeholder="Search" class="w-80" />
        <div class="flex space-x-2 items-center">
            <x-primary-button x-on:click="$openModal('showCreateModal')">
                Add category
            </x-primary-button>
        </div>
    </div>
    <div>
        @include('includes.datatables._categories')
    </div>
    <div>
        @include('includes.modals._category-create')
    </div>
    <div>
        @include('includes.modals._category-edit')
    </div>
</div>
