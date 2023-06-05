<x-tct.table :headers="['Role Name', 'Created At', '']">
    @forelse ($roles as $role)
        <tr>
            <x-tct.tcell>
                {{ $role->name }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $role->created_at->format('M d, Y') }}
            </x-tct.tcell>
            <x-tct.tcell>
                <div class="flex space-x-2 items-center justify-end">
                    @if ($role->name === 'ADMIN')
                        <x-badge>
                            Cannot Edit Admin Role
                        </x-badge>
                    @else
                        <x-button warning wire:click="edit({{ $role->id }})" flat icon="pencil" gray label="Edit" />
                        <x-button href="{{ route('role-permissions', ['id' => $role->id]) }}" primary flat icon="pencil"
                            gray label="Permissions" icon="cog" />
                    @endif
                </div>
            </x-tct.tcell>
        </tr>
    @empty
        <tr>
            <x-tct.empty-table colspan="3" />
        </tr>
    @endforelse
    <x-slot:footer>
        {{ $roles ? $roles->links() : '' }}
    </x-slot:footer>
</x-tct.table>
