<x-tct.table :headers="['Name', 'Computation', 'Created At', 'Created By', '']">
    @forelse ($categories as $category)
        <tr>
            <x-tct.tcell>
                {{ $category->name }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $formulas[$category->formula] }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $category->created_at->format('M d, Y') }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $category->creator->email }}
            </x-tct.tcell>
            <x-tct.tcell>
                <div class="flex space-x-2 items-center justify-end">
                    @can('edit category')
                        <x-button wire:click="edit({{ $category->id }})" flat icon="pencil" warning label="Edit" />
                    @else
                        <x-button flat icon="pencil" warning label="Edit"
                            x-on:confirm="{
                        title: 'Permission not granted',
                        description: 'You do not have permission to edit this category.',
                        icon: 'warning',
                    }" />
                    @endcan
                </div>
            </x-tct.tcell>
        </tr>
    @empty
        <tr>
            <x-tct.empty-table colspan="6" />
        </tr>
    @endforelse
    <x-slot:footer>
        {{ $categories ? $categories->links() : '' }}
    </x-slot:footer>
</x-tct.table>
