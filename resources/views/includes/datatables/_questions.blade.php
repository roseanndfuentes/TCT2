<x-tct.table :headers="['Questions', 'Options', 'Created At', 'Created By', '']">
    @forelse ($questions as $question)
        <tr>
            <x-tct.tcell>
                {{ $question->message }}
            </x-tct.tcell>
            <x-tct.tcell>
                @if ($question->options)
                    @php
                        $options = explode(',', $question->options);
                    @endphp
                    <select class="text-xs focus:border-0 border-0 focus:ring-0">
                        <option value="" hidden>View Options</option>
                        @foreach ($options as $option)
                            <option disabled value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                @else
                    <x-badge>N/A</x-badge>
                @endif
            </x-tct.tcell>

            <x-tct.tcell>
                {{ $question->created_at->format('M d, Y') }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $question->creator->email }}
            </x-tct.tcell>
            <x-tct.tcell>
                <div class="flex space-x-2 items-center justify-end">
                    <x-button wire:click="edit({{ $question->id }})" flat icon="pencil" warning label="Edit" />
                </div>
            </x-tct.tcell>
        </tr>
    @empty
        <tr>
            <x-tct.empty-table colspan="6" />
        </tr>
    @endforelse
    <x-slot:footer>
        {{ $questions ? $questions->links() : '' }}
    </x-slot:footer>
</x-tct.table>
