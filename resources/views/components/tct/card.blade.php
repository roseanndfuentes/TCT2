@props(['header' => ''])
<div class="w-full border rounded-lg bg-white">
    @if ($header != '')
        <div class="p-4 flex justify-between items-center w-full">
            {{ $header }}
        </div>
    @endif
    <div class="px-4">
        {{ $slot }}
    </div>
    <div class="mb-5">

    </div>
</div>
