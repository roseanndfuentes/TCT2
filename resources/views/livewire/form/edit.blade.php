<div class="space-y-3">
    {{-- @if ($form->submitted_by !== auth()->user()->id)/ --}}
    @foreach ($questions as $key => $question)
        <div wire:key="{{ $key . $question->id }}" class="border rounded-lg">
            <x-card shadow="none" title="Q{{ $key + 1 }}. {{ $question->message }}" x-animate>
                @if ($question->options != '')
                    <x-select-input class="w-full" wire:model.defer="answersForm.{{ $question->id }}">
                        <option value="">Select</option>
                        @foreach (explode(',', $question->options) as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </x-select-input>
                @else
                    <x-text-area wire:model.defer="answersForm.{{ $question->id }}" class="w-full" rows="2" />
                @endif
            </x-card>
        </div>
    @endforeach
    <div>
        <x-textarea label="Remarks" wire:model.defer="remarks" />
    </div>
    <div class="flex items-center space-x-3">
        <x-primary-button wire:click="update" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="update">Update</span>
            <span wire:loading wire:target="update">Updating...</span>
        </x-primary-button>
    </div>
    {{-- @else
        <div
            class="lg:px-24 lg:py-24 md:py-20 md:px-44 px-4 py-24 items-center flex justify-center flex-col-reverse lg:flex-row md:gap-28 gap-16">
            <div class="xl:pt-24 w-full xl:w-1/2 relative pb-12 lg:pb-0">
                <div class="relative">
                    <div class="absolute">
                        <div class="">
                            <h1 class="my-2 text-gray-800 font-bold text-2xl">
                                Unauthorized action
                            </h1>
                            <p class="my-2 text-gray-800">
                                Sorry, only the creator of this form can edit it.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif --}}
</div>
