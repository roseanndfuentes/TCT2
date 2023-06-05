<x-tct.table :headers="[
    'Task ',
    'Segment',
    'Ref (Document Validation)',
    'Ref (Per Company In Review)',
    'Ref (Start Review)',
    'Category',
    '',
]">
    @forelse ($tasks as $task)
        <tr>
            <x-tct.tcell>
                {{ $task->name }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $task->segment->name }}
            </x-tct.tcell>
            <x-tct.tcell>
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
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $task->category->name }}
            </x-tct.tcell>
            <x-tct.tcell>
                <div class="flex space-x-2 items-center justify-end">
                    <x-button wire:click="editTask({{ $task->id }})" flat icon="pencil" warning label="Edit" />
                    <x-button href="{{ route('task-questions', ['id' => $task->id]) }}" flat icon="clipboard-list" primary
                        label="Questions" />
                </div>
            </x-tct.tcell>
        </tr>
    @empty
        <tr>
            <x-tct.empty-table colspan="7" />
        </tr>
    @endforelse
    <x-slot:footer>
        {{ $tasks ? $tasks->links() : '' }}
    </x-slot:footer>
</x-tct.table>
