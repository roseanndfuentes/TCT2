<x-modal.card title="Edit Question" wire:model.defer="showEditModal">
    <div class="space-y-3 sm:grid sm:grid-cols-2">
        <div class="sm:col-span-2">
            <x-input-label for="question" required value="Question" />
            <div class="mt-1">
                <x-text-input type="text" name="question" wire:model.defer="editForm.question" class="w-full" />
            </div>
            @error('editForm.question')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="options" value="Options" />
            <div class="mt-1">
                <x-text-input type="text" name="options" placeholder="ex. Option1,Option2,Option3"
                    wire:model.defer="editForm.options" class="w-full" />
            </div>
            @error('editForm.options')
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
