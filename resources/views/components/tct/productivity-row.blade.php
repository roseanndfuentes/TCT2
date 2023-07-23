@props(['preLabel' => '', 'label' => '', 'value' => ''])

<tr {{ $attributes->merge(['class' => 'hover:bg-gray-100']) }}>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        <div class="w-full  grid space-y-2">
            <div class="flex space-x-2">
                <span>
                    {{ $preLabel }}
                </span>
                <span class="text-indigo-700 font-semibold">
                    {{ $label }}
                </span>
            </div>
        </div>
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        <div class="w-full  grid space-y-2">
            <div class="flex space-x-2">
                <span class="text-indigo-700">
                    {{ $value }}
                </span>
            </div>
        </div>
    </td>
</tr>
