@props(['headers' => [], 'footer' => ''])
<div class="flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    @if (count($headers) > 0)
                        <thead class="bg-gray-50">
                            <tr>
                                @foreach ($headers as $key => $header)
                                    <th scope="col" id="head-{{ $key }}"
                                        class="py-3.5 uppercase pl-4 pr-3 text-left text-sm font-semibold text-gray-500 sm:pl-6">
                                        {{ $header }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                    @endif
                    <tbody class="divide-y divide-gray-200 bg-white">
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if ($footer != '')
        <div class="mt-2">
            {{ $footer }}
        </div>
    @endif
</div>
