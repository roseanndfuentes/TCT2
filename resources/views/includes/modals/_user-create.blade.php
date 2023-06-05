<x-modal.card title="Add User" wire:model.defer="showCreateModal">
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
            <x-input-label for="email" required value="Email" />
            <div class="mt-1">
                <x-text-input type="email" name="email" wire:model.defer="createForm.email" class="w-full" />
            </div>
            @error('createForm.email')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="password" required value="Password" />
            <div class="mt-1">
                <x-text-input type="password" name="password" wire:model.defer="createForm.password" class="w-full" />
            </div>
            @error('createForm.password')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="role" value="Role" required />
            <div class="mt-1">
                <x-select-input wire:model.defer="createForm.role" name="role" class="w-full">
                    <option value="" hidden>Select</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </x-select-input>
                @error('createForm.role')
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
