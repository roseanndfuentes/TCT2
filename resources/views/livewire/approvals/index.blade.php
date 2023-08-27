<div x-data class="space-y-4">
    <div class="flex justify-between">
        <x-text-input wire:model.debounce.500ms="search" type="search" placeholder="Search" class="w-80" />
        <div class="flex space-x-2 items-center">
        </div>
    </div>
    <div>
        @include('includes.datatables._approvables')
    </div>

    {{-- <div>
        @include('includes.modals._company-create')
    </div> --}}

    {{-- <div>
        @include('includes.modals._company-edit')
    </div> --}}
</div>
