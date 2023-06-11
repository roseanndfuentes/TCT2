<x-modal.card title="Edit Header" wire:model.defer="editMinimumConsumableFeeHeaderModal">
    <div class="space-y-3 sm:grid sm:grid-cols-2">
        <div class="sm:col-span-2">
            <x-input-label for="name" required value="Header Title" />
            <div class="mt-1">
                <x-text-input type="text" name="name" wire:model.defer="consumable_header_title" class="w-full" />
            </div>
            @error('consumable_header_title')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
    </div>
    <x-slot:footer>
        <div class="flex justify-end items-center space-x-2">
            <x-secondary-button x-on:click="close">
                Cancel
            </x-secondary-button>
            <x-primary-button wire:click="updateConsumableHeader" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="updateConsumableHeader">Save</span>
                <span wire:loading wire:target="updateConsumableHeader">Saving...</span>
            </x-primary-button>
        </div>
    </x-slot:footer>
</x-modal.card>
