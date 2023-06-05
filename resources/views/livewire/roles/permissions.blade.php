<div>
    <x-tct.card>
        <x-slot:header>
            <span class="text-lg">
                <span class="text-indigo-600 font-semibold">{{ $role->name }}</span> 's permissions
            </span>
        </x-slot:header>
        <div>
            <x-text-input type="search" placeholder="Search" wire:model.debounce.500ms="search" class="w-80" />
        </div>
        <ul role="list" class="divide-y divide-gray-100">
            @foreach ($permissions as $key => $permission)
                <li wire:key="{{ $key }}-permissions" class="flex items-center justify-between gap-x-6 py-5">
                    <div class="min-w-0">
                        <div class="flex items-start gap-x-3">
                            <p class="text-sm font-semibold leading-6 uppercase text-gray-900">
                                {{ $permission->name }}
                            </p>
                            @if ($role->hasPermissionTo($permission->name))
                                <p
                                    class="rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset text-green-700 bg-green-50 ring-green-600/20">
                                    Granted
                                </p>
                            @else
                                <p
                                    class="rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset text-gray-700 bg-gray-50 ring-gray-600/20">
                                    Not Granted
                                </p>
                            @endif
                        </div>
                        <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                            <p class="whitespace-nowrap">
                                {{ $description[$permission->name] }}
                            </p>
                        </div>
                    </div>
                    @if ($role->hasPermissionTo($permission->name))
                        <div id="{{ $key }}-revoke-button" class="flex flex-none items-center gap-x-4">
                            <button wire:click="revoke({{ $permission->id }})" wire:loading.attr="disabled"
                                class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-red-600 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block">
                                <span wire:loading.remove wire:target="revoke({{ $permission->id }})">
                                    Revoke
                                </span>
                                <span wire:loading wire:target="revoke({{ $permission->id }})">
                                    Revoking...
                                </span>
                            </button>
                        </div>
                    @else
                        <div id="{{ $key }}-grant-button" class="flex flex-none items-center gap-x-4">
                            <button wire:click="grant({{ $permission->id }})" wire:loading.attr="disabled"
                                class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-green-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block">
                                <span wire:loading.remove wire:target="grant({{ $permission->id }})">
                                    Grant
                                </span>
                                <span wire:loading wire:target="grant({{ $permission->id }})">
                                    Granting...
                                </span>
                            </button>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </x-tct.card>
</div>
