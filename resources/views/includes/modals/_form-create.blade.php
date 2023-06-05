<x-modal.card title="Start New Form" wire:model.defer="showStartFormModal">
    <div class="space-y-3 sm:grid sm:grid-cols-2">
        <div class="sm:col-span-2">
            <x-input-label for="company" value="Choose Company" required />
            <div class="mt-1">
                <x-select-input wire:model="createForm.company_id" name="company" class="w-full">
                    <option value="" hidden>Select</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </x-select-input>
                @error('createForm.company_id')
                    <x-validation-error>{{ $message }}</x-validation-error>
                @enderror
            </div>
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="segment" value="Choose Segment" required />
            <div class="mt-1">
                <x-select-input wire:model="createForm.segment_id" name="segment" class="w-full">
                    <option value="" hidden>Select</option>
                    @foreach ($segments as $segment)
                        <option value="{{ $segment->id }}">{{ $segment->name }}</option>
                    @endforeach
                </x-select-input>
                @error('createForm.segment_id')
                    <x-validation-error>{{ $message }}</x-validation-error>
                @enderror
            </div>
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="task" value="Choose task" required />
            <div class="mt-1">
                <x-select-input wire:model="createForm.task_id" name="task" class="w-full">
                    <option value="" hidden>Select</option>
                    @foreach ($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->name }}</option>
                    @endforeach
                </x-select-input>
                @error('createForm.task_id')
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
                <span wire:loading.remove wire:target="store">Start Form</span>
                <span wire:loading wire:target="store">Generating form...</span>
            </x-primary-button>
        </div>
    </x-slot:footer>
</x-modal.card>
