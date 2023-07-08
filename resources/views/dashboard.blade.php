<x-admin-layout>
    <x-slot:title>
        <div class="flex space-x-2 items-center  text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-indigo-600">
                <path
                    d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z" />
                <path
                    d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z" />
            </svg>
            <span class="text-xl font-bold">
                Dashboard
            </span>
        </div>
    </x-slot:title>
    <div>
        <h3 class="text-xl font-semibold leading-6 text-gray-900">
            Statistic Overview
        </h3>
        <div>
            @livewire('dashboard.statistics-overview')
        </div>
        <div class="mt-5 grid grid-cols-12">
            <div class="sm:col-span-8">
                @livewire('charts.last-seven-day-chart')
            </div>
        </div>
    </div>
</x-admin-layout>
