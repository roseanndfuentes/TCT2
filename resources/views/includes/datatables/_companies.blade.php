<x-tct.table :headers="['Company Name', 'Created At', 'Created By', '']">
    @forelse ($companies as $company)
        <tr>
            <x-tct.tcell>
                {{ $company->name }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $company->created_at->format('M d, Y') }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $company->creator->email }}
            </x-tct.tcell>
            <x-tct.tcell>
                <div class="flex space-x-2 items-center justify-end">
                    @can('edit company')
                        <x-button warning wire:click="edit({{ $company->id }})" flat icon="pencil" label="Edit" />
                    @endcan
                    <x-button primary href="{{ route('company-settings', ['id' => $company->id]) }}" flat icon="pencil"
                        gray label="Manage" icon="cog" />
                    @can('delete company')
                        <x-button flat icon="trash"
                            x-on:confirm="{
                            title : 'Delete Company',
                            description : 'Are you sure you want to delete this record?',
                            method:'delete', 
                            params : '{{ $company->id }}' }"
                            negative label="Delete" />
                    @endcan
                </div>
            </x-tct.tcell>
        </tr>
    @empty
        <tr>
            <x-tct.empty-table colspan="4" />
        </tr>
    @endforelse
    <x-slot:footer>
        {{ $companies ? $companies->links() : '' }}
    </x-slot:footer>
</x-tct.table>
