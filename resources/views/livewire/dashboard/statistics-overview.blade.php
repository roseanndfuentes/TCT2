<div x-data="">
    <dl id="c2304orfjrhoq3w74u89320" class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
        <div class="overflow-hidden relative rounded-lg bg-white px-4 py-5 border border-gray-300 sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Task Submitted</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                {{ $formReport->submitted }}
            </dd>
            <span class="absolute top-7 right-7 p-2 bg-green-100 rounded-lg text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                </svg>
            </span>
        </div>
        <div class="overflow-hidden relative rounded-lg bg-white px-4 py-5 border border-gray-300 sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Task In Progress</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                {{ $formReport->in_progress }}
            </dd>
            <span class="absolute top-7 right-7 p-2 bg-yellow-100 rounded-lg text-yellow-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
            </span>
        </div>
        <div class="overflow-hidden relative rounded-lg bg-white px-4 py-5 border border-gray-300 sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Task Paused</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                {{ $formReport->paused }}
            </dd>
            <span class="absolute top-7 right-7 p-2 bg-red-100 rounded-lg text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
        </div>
    </dl>
    <dl id="djasd93q29e10v30rw8aja8u" class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
        <div class="relative overflow-hidden rounded-lg bg-white px-4 py-5 border border-gray-300 sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Total Companies</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                {{ $otherStats['total_companies'] }}
            </dd>
            <span class="absolute top-7 right-7 p-2 bg-blue-100 rounded-lg text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                </svg>
            </span>
        </div>
        <div class="overflow-hidden rounded-lg relative bg-white px-4 py-5 border border-gray-300 sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">Total User</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                {{ $otherStats['total_users'] }}
            </dd>
            <span class="absolute top-7 right-7 p-2 bg-gray-100 rounded-lg text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>
            </span>
        </div>
    </dl>
</div>
