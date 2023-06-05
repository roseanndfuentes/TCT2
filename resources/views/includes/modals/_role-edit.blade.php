<x-modal.card title="Edit Role" wire:model.defer="showEditModal">
    <div class="space-y-3 sm:grid sm:grid-cols-2">
        <div class="sm:col-span-2">
            <x-input-label for="name" required value="Name" />
            <div class="mt-1">
                <x-text-input type="text" name="name" wire:model.defer="editForm.name" class="w-full" />
            </div>
            @error('editForm.name')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
    </div>
    <x-slot:footer>
        <div class="flex justify-end items-center space-x-2">
            <x-secondary-button x-on:click="close">
                Cancel
            </x-secondary-button>
            <x-primary-button wire:click="update" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="update">Update</span>
                <span wire:loading wire:target="update">Updating...</span>
            </x-primary-button>
        </div>
    </x-slot:footer>
</x-modal.card>
