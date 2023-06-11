<x-modal.card title="Edit Header" wire:model.defer="editBasicDiligenceHeaderModal">
    <div class="space-y-3 sm:grid sm:grid-cols-2">
        <div class="sm:col-span-2">
            <x-input-label for="name" required value="Header Title" />
            <div class="mt-1">
                <x-text-input type="text" name="name" wire:model.defer="basic_diligence_header_title"
                    class="w-full" />
            </div>
            @error('basic_diligence_header_title')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
    </div>
    <x-slot:footer>
        <div class="flex justify-end items-center space-x-2">
            <x-secondary-button x-on:click="close">
                Cancel
            </x-secondary-button>
            <x-primary-button wire:click="updateBasicDiligenceHeader" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="updateBasicDiligenceHeader">Save</span>
                <span wire:loading wire:target="updateBasicDiligenceHeader">Saving...</span>
            </x-primary-button>
        </div>
    </x-slot:footer>
</x-modal.card>
