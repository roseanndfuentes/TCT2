<x-modal.card title="Edit User" wire:model.defer="showEditModal">
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
            <x-input-label for="email" required value="Email" />
            <div class="mt-1">
                <x-text-input type="email" name="email" wire:model.defer="editForm.email" class="w-full" />
            </div>
            @error('editForm.email')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="role" value="Role" required />
            <div class="mt-1">
                <x-select-input wire:model.defer="editForm.role" name="role" class="w-full">
                    <option value="" hidden>Select</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </x-select-input>
                @error('editForm.role')
                    <x-validation-error>{{ $message }}</x-validation-error>
                @enderror
            </div>
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="status" value="Status" required />
            <div class="mt-1">
                <x-select-input wire:model.defer="editForm.is_active" name="status" class="w-full">
                    <option value="" hidden>Select</option>
                    <option value="1">ACTIVE</option>
                    <option value="0">INACTIVE</option>
                </x-select-input>
                @error('editForm.role')
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
            <x-primary-button wire:click="update" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="update">Update</span>
                <span wire:loading wire:target="update">Updating...</span>
            </x-primary-button>
        </div>
    </x-slot:footer>
</x-modal.card>
