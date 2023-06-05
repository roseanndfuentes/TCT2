<x-modal.card title="Add Category" wire:model.defer="showCreateModal">
    <div class="space-y-3 sm:grid sm:grid-cols-2">
        <div class="sm:col-span-2">
            <x-input-label for="name" required value="Name" />
            <div class="mt-1">
                <x-text-input type="text" name="name" wire:model.defer="createForm.name" class="w-full" />
            </div>
            @error('createForm.name')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="formula" value="Formula" required />
            <div class="mt-1">
                <x-select-input wire:model.defer="createForm.formula" name="formula" class="w-full">
                    <option value="" hidden>Select</option>
                    @foreach ($formulas as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-select-input>
                @error('createForm.formula')
                    <x-validation-error>{{ $message }}</x-validation-error>
                @enderror
            </div>
        </div>
    </div>
    <x-slot:footer>
        <div class="flex justify-end items-center space-x-2">
            <x-secondary-button x-on:click="close">
                Cancel
            </x-secondary-button>
            <x-primary-button wire:click="store" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="store">Save</span>
                <span wire:loading wire:target="store">Saving...</span>
            </x-primary-button>
        </div>
    </x-slot:footer>
</x-modal.card>
