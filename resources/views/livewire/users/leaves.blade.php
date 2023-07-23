<div>
    <table class="min-w-full bg-white border rounded-lg">
        <thead>
            <thead>
                <td colspan="4" class="py-2 px-4 font-bold text-indigo-700 border border-gray-200">
                    Details
                </td>
            </thead>
        </thead>
        <tbody>
            <tr>
                <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                    Name
                </td>
                <td class="py-2  px-4  text-gray-700 border border-gray-200">
                    {{ $user->name }}
                </td>
                <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                    Status
                </td>
                <td class="py-2  px-4  text-gray-700 border border-gray-200">
                    @if ($user->is_active)
                        <x-badge positive>Active</x-badge>
                    @else
                        <x-badge negative>Inactive</x-badge>
                    @endif
                </td>
            </tr>
            <tr>
                <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                    Role
                </td>
                <td class="py-2  px-4  text-gray-700 border border-gray-200">
                    {{ $user->getRoleNames()->first() }}
                </td>
                <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                    Total Leave Count
                </td>
                <td class="py-2  px-4  text-gray-700 border border-gray-200">
                    {{ $user->leaves->count() }}
                </td>
            </tr>
            <tr>
                <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                    Email
                </td>
                <td class="py-2  px-4  text-gray-700 border border-gray-200">
                    {{ $user->email }}
                </td>
            </tr>
        </tbody>
    </table>
    <div class="mt-6 space-y-4">
        <div class="flex justify-between ">
            <x-text-input wire:model="dateFilter" type="date" placeholder="Search" class="w-80" />
            <div class="flex space-x-2 items-center">
                <x-primary-button x-on:click="$openModal('showCreateModal')">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                        </svg>
                    </x-slot:icon>
                    <span class="ml-2">Add Leave</span>
                </x-primary-button>
            </div>
        </div>
        @include('includes.datatables._leaves')
        <div>
            @include('includes.modals._leave-create')
        </div>

        <div>
            @include('includes.modals._leave-edit')
        </div>
    </div>
</div>
