<div class="space-y-4">
    @include('includes.partials._form-details')
    <div class="flex space-x-2">
        @if ($form->isInProgress())
            <x-warning-button wire:click="pause" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd"
                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM9 8.25a.75.75 0 00-.75.75v6c0 .414.336.75.75.75h.75a.75.75 0 00.75-.75V9a.75.75 0 00-.75-.75H9zm5.25 0a.75.75 0 00-.75.75v6c0 .414.336.75.75.75H15a.75.75 0 00.75-.75V9a.75.75 0 00-.75-.75h-.75z"
                        clip-rule="evenodd" />
                </svg>
                <span class="ml-2">Pause</span>
            </x-warning-button>
            <x-secondary-button wire:click="submit" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd"
                        d="M15.75 2.25H21a.75.75 0 01.75.75v5.25a.75.75 0 01-1.5 0V4.81L8.03 17.03a.75.75 0 01-1.06-1.06L19.19 3.75h-3.44a.75.75 0 010-1.5zm-10.5 4.5a1.5 1.5 0 00-1.5 1.5v10.5a1.5 1.5 0 001.5 1.5h10.5a1.5 1.5 0 001.5-1.5V10.5a.75.75 0 011.5 0v8.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V8.25a3 3 0 013-3h8.25a.75.75 0 010 1.5H5.25z"
                        clip-rule="evenodd" />
                </svg>
                <span class="ml-2">Submit</span>
            </x-secondary-button>
        @elseif ($form->isPaused())
            <x-success-button wire:click="resume" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd"
                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm14.024-.983a1.125 1.125 0 010 1.966l-5.603 3.113A1.125 1.125 0 019 15.113V8.887c0-.857.921-1.4 1.671-.983l5.603 3.113z"
                        clip-rule="evenodd" />
                </svg>
                <span class="ml-2">Resume</span>
            </x-success-button>
        @endif
    </div>

    <div class="space-y-3">
        <div class="border rounded-lg">
            <x-card shadow="none" title="Initial Interview" x-animate>
                @if ($form->isInProgress())
                    <x-select-input wire:model="initialInterview" class="w-full">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </x-select-input>
                @else
                    <x-badge>
                        {{ $form->initial_review ? 'Yes' : 'No' }}
                    </x-badge>
                @endif
            </x-card>
        </div>
        @foreach ($questions as $key => $question)
            <div wire:key="{{ $key . $question->id }}" class="border rounded-lg">
                <x-card shadow="none" title="Q{{ $key + 1 }}. {{ $question->message }}" x-animate>
                    @if ($form->isInProgress())
                        @if ($question->options != '')
                            <x-select-input class="w-full" wire:model.debounce.1000ms="answersForm.{{ $question->id }}">
                                <option value="">Select</option>
                                @foreach (explode(',', $question->options) as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </x-select-input>
                        @else
                            <x-text-area wire:model.debounce.1000ms="answersForm.{{ $question->id }}" class="w-full"
                                rows="2" />
                        @endif
                    @else
                        <p class="text-gray-700">
                            {{ $answersForm[$question->id] ?? 'N/A' }}
                        </p>
                    @endif
                </x-card>
            </div>
        @endforeach
    </div>
</div>
