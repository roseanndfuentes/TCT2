<x-tct.table :headers="['Name', 'Email', 'Status', 'Created At', 'Role', 'Created By', '']">
    @forelse ($users as $user)
        <tr wire:key="{{ $user->id }}">
            <x-tct.tcell>
                {{ $user->name }}
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $user->email }}
            </x-tct.tcell>
            <x-tct.tcell>
                @if ($user->is_active)
                    <x-badge positive>Active</x-badge>
                @else
                    <x-badge negative>Inactive</x-badge>
                @endif
            </x-tct.tcell>
            <x-tct.tcell>
                {{ $user->created_at->format('M d, Y') }}
            </x-tct.tcell>
            <x-tct.tcell>
                @foreach ($user->roles as $role)
                    <x-badge wire:key="{{ $user->id }}-{{ $role->id }}">
                        {{ $role->name }}
                    </x-badge>
                @endforeach
            </x-tct.tcell>
            <x-tct.tcell>
                @if ($user->creator)
                    {{ $user->creator->email }}
                @else
                    <x-badge>
                        System Default
                    </x-badge>
                @endif
            </x-tct.tcell>
            <x-tct.tcell>
                <div class="flex space-x-2 items-center justify-end">
                    <x-button warning wire:click="edit({{ $user->id }})" flat icon="pencil" label="Edit" />
                    <x-button primary href="{{ route('user-leaves', ['id' => $user->id]) }}" flat icon="paper-clip"
                        label="Manage Leaves" />
                </div>
            </x-tct.tcell>
        </tr>
    @empty
        <tr>
            <x-tct.empty-table colspan="4" />
        </tr>
    @endforelse
    <x-slot:footer>
        {{ $users ? $users->links() : '' }}
    </x-slot:footer>
</x-tct.table>
