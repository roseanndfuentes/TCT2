@props(['name' => '', 'total' => '', 'allowEdit' => false, 'modalName' => null])
<tr class="">
    <td class="py-2 px-4 font-bold relative text-indigo-700  border border-gray-200">
        <div x-data="{ showEdit: false }" x-on:mouseover="showEdit=true" x-on:mouseleave="showEdit=false">
            <span> {{ $name }}</span>
            @if ($allowEdit)
                <button x-show="showEdit" x-cloak
                    @if ($modalName) x-on:click="$openModal('{{ $modalName }}')" @endif
                    class="text-yellow-500 absolute right-4 top-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path
                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                    </svg>
                </button>
            @endif
        </div>
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ $total }}
    </td>
</tr>
