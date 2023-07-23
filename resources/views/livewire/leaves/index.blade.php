<div x-data class="space-y-4">
    <div class="flex justify-between">
        <x-text-input wire:model.debounce.500ms="search" type="search" placeholder="Search" class="w-80" />
    </div>
    <div>
        @include('includes.datatables._leaves')
    </div>
    {{-- 
    <div>
        @include('includes.modals._company-create')
    </div>

    <div>
        @include('includes.modals._company-edit')
    </div> --}}
</div>
