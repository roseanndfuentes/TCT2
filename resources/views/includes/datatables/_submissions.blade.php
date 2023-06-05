<x-tct.table :headers="['Task ID', 'Company', 'Submitted By', 'Paused ID', 'Status', '']">
    @forelse ($forms as $form)
        <tr>
            <x-tct.tcell>
                {{ $form->record_number }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $form->company->name }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $form->submitter->name }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $form->pause_id ?? 'N/A' }}
            </x-tct.tcell>
            <x-tct.tcell>
                @if ($form->isInProgress())
                    <x-badge warning outline>
                        {{ $statuses[$form->status] }}
                    </x-badge>
                @elseif ($form->isPaused())
                    <x-badge>
                        {{ $statuses[$form->status] }}
                    </x-badge>
                @elseif ($form->isSubmitted())
                    <x-badge positive outline>
                        {{ $statuses[$form->status] }}
                    </x-badge>
                @endif
            </x-tct.tcell>
            <x-tct.tcell>
                <div class="flex space-x-2 items-center justify-end">
                    <x-button href="/submissions/form/{{ $form->id }}/starter" flat icon="eye" primary
                        label="Open" />
                </div>
            </x-tct.tcell>
        </tr>
    @empty
        <tr>
            <x-tct.empty-table colspan="6" />
        </tr>
    @endforelse
    <x-slot:footer>
        {{ $forms ? $forms->links() : '' }}
    </x-slot:footer>
</x-tct.table>
