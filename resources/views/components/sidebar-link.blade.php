@props([
    'active' => false,
    'href' => '#',
    'label' => '',
])
<li>
    <a href="{{ $href }}"
        class="{{ $active ? 'bg-indigo-700' : '' }} text-indigo-200 hover:text-white hover:bg-indigo-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
        {{ $slot }}
        {{ $label }}
    </a>
</li>
