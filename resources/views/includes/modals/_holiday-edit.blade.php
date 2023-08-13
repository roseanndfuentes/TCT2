<x-modal.card title="Edit Holiday" wire:model.defer="showEditModal">
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
        <div class="sm:col-span-2">
            <x-input-label for="date_start" required value="Date Start" />
            <div class="mt-1">
                <x-text-input type="date" name="date_start" wire:model.defer="editForm.date_start" class="w-full" />
            </div>
            @error('editForm.date_start')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="date_end" required value="End Start" />
            <div class="mt-1">
                <x-text-input type="date" name="date_end" wire:model.defer="editForm.date_end" class="w-full" />
            </div>
            @error('editForm.date_end')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
    </div>
    <x-slot:footer>
        <div class="flex justify-between items-center">
            <div wire:key="has-editable">
                @if ($editable)
                    <x-danger-button
                        x-on:confirm="{
                        title: 'Sure Delete?',
                        icon: 'warning',
                        method: 'delete',
                    }">
                        Delete
                    </x-danger-button>
                @endif
            </div>
            <div class="flex items-center space-x-2">
                <x-secondary-button x-on:click="close">
                    Cancel
                </x-secondary-button>
                <x-primary-button wire:click="update" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="update">Update</span>
                    <span wire:loading wire:target="update">Updating...</span>
                </x-primary-button>
            </div>
        </div>
    </x-slot:footer>
</x-modal.card>
