<x-tct.table :headers="['Task ', 'Segment', 'Category', '']">
    @forelse ($tasks as $task)
        <tr>
            <x-tct.tcell>
                {{ $task->name }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $task->segment->name }}
            </x-tct.tcell>
            {{-- <x-tct.tcell>
                @if ($task->is_document_review_reference)
                    <x-badge positive>Yes</x-badge>
                @else
                    <x-badge>No</x-badge>
                @endif
            </x-tct.tcell>
            <x-tct.tcell>
                @if ($task->count_per_company_review)
                    <x-badge positive>Yes</x-badge>
                @else
                    <x-badge>No</x-badge>
                @endif
            </x-tct.tcell>
            <x-tct.tcell>
                @if ($task->review_starter)
                    <x-badge positive>Yes</x-badge>
                @else
                    <x-badge>No</x-badge>
                @endif
            </x-tct.tcell> --}}
            <x-tct.tcell>
                <x-badge>
                    {{ $task->category ? $task->category->name : 'N/A' }}
                </x-badge>
            </x-tct.tcell>
            <x-tct.tcell>
                <div class="flex space-x-2 items-center justify-end">
                    <x-button wire:click="editTask({{ $task->id }})" flat icon="pencil" warning label="Edit" />
                    <x-button wire:click="showTask({{ $task->id }})" flat icon="eye" gray label="View Details" />
                    <x-button href="{{ route('task-questions', ['id' => $task->id]) }}" flat icon="clipboard-list" primary
                        label="Questions" />
                </div>
            </x-tct.tcell>
        </tr>
    @empty
        <tr>
            <x-tct.empty-table colspan="4" />
        </tr>
    @endforelse
    <x-slot:footer>
        {{ $tasks ? $tasks->links() : '' }}
    </x-slot:footer>
</x-tct.table>
