<x-modal.card title="Add Question" wire:model.defer="showCreateModal">
    <div class="space-y-3 sm:grid sm:grid-cols-2">
        <div class="sm:col-span-2">
            <x-input-label for="question" required value="Question" />
            <div class="mt-1">
                <x-text-input type="text" name="question" wire:model.defer="createForm.question" class="w-full" />
            </div>
            @error('createForm.question')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="options" value="Options" />
            <div class="mt-1">
                <x-text-input type="text" name="options" placeholder="ex. Option1,Option2,Option3"
                    wire:model.defer="createForm.options" class="w-full" />
            </div>
            @error('createForm.options')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
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
