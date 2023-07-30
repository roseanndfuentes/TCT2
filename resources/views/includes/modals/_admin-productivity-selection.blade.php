<x-modal.card title="Select Admin Productivity" wire:model.defer="showAdminProductivityModal">
    <div class="space-y-3 sm:grid sm:grid-cols-2">
        <div class="sm:col-span-2">
            <x-input-label for="segment" value="Segment" required />
            <div class="mt-1">
                <x-select-input wire:model.defer="selectedProductivitySegment" name="segment" class="w-full">
                    <option value="" hidden>Select</option>
                    @foreach ($segmentList as $segment)
                        @if (!in_array($segment->id, $adminProductivitySegmentCollectionIds))
                            <option value="{{ $segment->id }}">{{ $segment->company->name }}-{{ $segment->name }}
                            </option>
                        @endif
                    @endforeach
                </x-select-input>
            </div>
        </div>
    </div>
    <x-slot:footer>
        <div class="flex justify-end items-center space-x-2">
            <x-secondary-button x-on:click="close">
                Cancel
            </x-secondary-button>
            <x-primary-button wire:click="saveSegment" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="saveSegment">Save</span>
                <span wire:loading wire:target="saveSegment">Saving...</span>
            </x-primary-button>
        </div>
    </x-slot:footer>
</x-modal.card>
