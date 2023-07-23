<x-tct.table :headers="['Type', 'Reason', 'Shift Type', 'Computed Minutes', 'Work Week', 'Date', '']">
    @forelse ($leaves as $leave)
        <tr>
            <x-tct.tcell>
                {{ $leaveTypes[$leave->type] }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $leave->reason }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $shiftTypes[$leave->shift_type] }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $leave->computed_minutes }} {{ Str::plural('min', $leave->computed_minutes) }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $leave->work_week }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $leave->year }}
            </x-tct.tcell>
            <x-tct.tcell>
                <div class="flex space-x-2 items-center justify-end">
                    <x-button warning wire:click="edit({{ $leave->id }})" flat icon="pencil" gray label="Edit" />
                    <x-button negative
                        x-on:confirm="{
                        title: 'Delete Leave',
                        icon: 'warning',
                        method: 'delete',
                        params: '{{ $leave->id }}'
                        }"
                        flat icon="trash" label="Delete" />
                </div>
            </x-tct.tcell>
        </tr>
    @empty
        <tr>
            <x-tct.empty-table colspan="7" />
        </tr>
    @endforelse
    <x-slot:footer>
        {{ $leaves ? $leaves->links() : '' }}
    </x-slot:footer>
</x-tct.table>
