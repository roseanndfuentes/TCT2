<x-modal.card title="Edit Task" wire:model.defer="showEditTaskModal">
    <div class="space-y-3 sm:grid sm:grid-cols-2">
        <div class="sm:col-span-2">
            <x-input-label for="name" required value="Name" />
            <div class="mt-1">
                <x-text-input type="text" name="name" wire:model.defer="editTaskForm.name" class="w-full" />
            </div>
            @error('editTaskForm.name')
                <x-validation-error>{{ $message }}</x-validation-error>
            @enderror
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="amount" value="Amount" required />
            <div class="mt-1">
                <x-text-input wire:model.defer="editTaskForm.amount" type="text" class="w-full" name="amount" />
                @error('editTaskForm.amount')
                    <x-validation-error>{{ $message }}</x-validation-error>
                @enderror
            </div>
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="category" value="Category" required />
            <div class="mt-1">
                <x-select-input wire:model.defer="editTaskForm.category_id" name="category" class="w-full">
                    <option value="" hidden>Select</option>
                    @foreach ($categories as $key => $category)
                        <option value="">Not Application</option>
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select-input>
                @error('editTaskForm.category_id')
                    <x-validation-error>{{ $message }}</x-validation-error>
                @enderror
            </div>
        </div>

        <div class="sm:col-span-2">
            <x-input-label for="dv_ref" value="Make it document validation reference" required />
            <div class="mt-1">
                <x-select-input wire:model.defer="editTaskForm.is_document_review_reference" name="dv_ref"
                    class="w-full">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                </x-select-input>
                @error('editTaskForm.is_document_review_reference')
                    <x-validation-error>{{ $message }}</x-validation-error>
                @enderror
            </div>
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="per_review" value="Reference for (per company in review)" required />
            <div class="mt-1">
                <x-select-input wire:model.defer="editTaskForm.per_company_in_review" name="per_review" class="w-full">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                </x-select-input>
                @error('editTaskForm.per_company_in_review')
                    <x-validation-error>{{ $message }}</x-validation-error>
                @enderror
            </div>
        </div>
        <div class="sm:col-span-2">
            <x-input-label for="review_starter" value="Reference for (Start Review)" required />
            <div class="mt-1">
                <x-select-input wire:model.defer="editTaskForm.review_starter" name="review_starter" class="w-full">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                </x-select-input>
                @error('editTaskForm.review_starter')
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
            <x-primary-button wire:click="updateTask" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="updateTask">Update</span>
                <span wire:loading wire:target="updateTask">Updating...</span>
            </x-primary-button>
        </div>
    </x-slot:footer>
</x-modal.card>
