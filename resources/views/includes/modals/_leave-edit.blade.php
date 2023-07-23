<x-modal.card title="Edit Leave" wire:model.defer="showEditModal">
    <div class="space-y-3 sm:grid sm:grid-cols-2">
        <div class="sm:col-span-2">
            <x-input-label for="type" required value="Type" />
            <div class="mt-1">
                <x-select-input name="type" wire:model.defer="editForm.type" class="w-full">
                    <option value="">Select Type</option>
                    @foreach ($leaveTypes as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-select-input>
            </div>
            @error('editForm.type')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>

        <div class="sm:col-span-2">
            <x-input-label for="shigt_type" required value="Shift Type" />
            <div class="mt-1">
                <x-select-input name="shigt_type" wire:model="editForm.shift_type" class="w-full">
                    <option value="">Select Shift Type</option>
                    @foreach ($shiftTypes as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-select-input>
            </div>
            @error('editForm.shift_type')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="reason" required value="Reason" />
            <div class="mt-1">
                <x-text-area name="reason" wire:model.defer="editForm.reason" class="w-full" />
            </div>
            @error('editForm.reason')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="computed_minutes" required value="Computed minutes" />
            <div class="mt-1">
                <x-text-input type="number" name="computed_minutes" wire:model.defer="editForm.computed_minutes"
                    class="w-full" />
            </div>
            @error('editForm.computed_minutes')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>

        <div class="sm:col-span-2">
            <x-input-label for="year" required value="Date" />
            <div class="mt-1">
                <x-text-input type="date" name="year" wire:model="editForm.year" class="w-full" />
            </div>
            @error('editForm.year')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="work_week" required value="Work week" />
            <div class="mt-1">
                <x-text-input type="number" name="work_week" wire:model.defer="editForm.work_week" class="w-full" />
            </div>
            @error('editForm.work_week')
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
