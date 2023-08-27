<x-tct.table :headers="['Module', 'Status', 'Request For', 'Request By', '']">
    @forelse ($approvals as $approval)
        <tr>
            <x-tct.tcell>
                {{ $approval->module }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $approval->status }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $approval->action }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $approval->requestor->name }}
            </x-tct.tcell>
            <x-tct.tcell>
                <div class="flex space-x-2 items-center">
                    <x-button positive wire:click="approve({{ $approval->id }})" flat label="Approve" />
                </div>
            </x-tct.tcell>
        </tr>
    @empty
        <tr>
            <x-tct.empty-table colspan="5" />
        </tr>
    @endforelse
    <x-slot:footer>
        {{ $approvals ? $approvals->links() : '' }}
    </x-slot:footer>
</x-tct.table>
