<x-modal.card title="Add Segment" wire:model.defer="showCreateSegmentModal">
    <div class="space-y-3 sm:grid sm:grid-cols-2">
        <div class="sm:col-span-2">
            <x-input-label for="name" required value="Name" />
            <div class="mt-1">
                <x-text-input type="text" name="name" wire:model.defer="createSegmentForm.name" class="w-full" />
            </div>
            @error('createSegmentForm.name')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
    </div>
    <x-slot:footer>
        <div class="flex justify-end items-center space-x-2">
            <x-secondary-button x-on:click="close">
                Cancel
            </x-secondary-button>
            <x-primary-button wire:click="storeSegment" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="storeSegment">Save</span>
                <span wire:loading wire:target="storeSegment">Saving...</span>
            </x-primary-button>
        </div>
    </x-slot:footer>
</x-modal.card>
