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


    <div x-data="{
        tabSelected: 1,
        tabId: $id('tabs'),
        tabButtonClicked(tabButton) {
            this.tabSelected = tabButton.id.replace(this.tabId + '-', '');
            this.tabRepositionMarker(tabButton);
        },
        tabRepositionMarker(tabButton) {
            this.$refs.tabMarker.style.width = tabButton.offsetWidth + 'px';
            this.$refs.tabMarker.style.height = tabButton.offsetHeight + 'px';
            this.$refs.tabMarker.style.left = tabButton.offsetLeft + 'px';
        },
        tabContentActive(tabContent) {
            return this.tabSelected == tabContent.id.replace(this.tabId + '-content-', '');
        }
    }" x-init="tabRepositionMarker($refs.tabButtons.firstElementChild);" class="relative w-full max-full">

        <div x-ref="tabButtons"
            class="relative inline-grid items-center justify-center w-full  h-10 grid-cols-3 p-1 border border-gray-200 text-gray-500 bg-gray-100 rounded-lg select-none">
            <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button"
                class="relative z-20 inline-flex items-center justify-center w-full h-8 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">Statistic
                Overview</button>
            <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button"
                class="relative z-20 inline-flex items-center justify-center w-full h-8 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">Productivity</button>
            <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button"
                class="relative z-20 inline-flex items-center justify-center w-full h-8 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">Breakdown</button>
            <div x-ref="tabMarker" class="absolute left-0 z-10 w-1/2 h-full duration-300 ease-out" x-cloak>
                <div class="w-full h-full bg-white rounded-md shadow-sm"></div>
            </div>
        </div>
        <div class="relative w-full mt-2 content">
            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative">
                <!-- Tab Content 1 - Replace with your content -->
                <div>
                    <div>
                        @livewire('dashboard.statistics-overview')
                    </div>
                    <div class="mt-5 grid grid-cols-12">
                        <div class="sm:col-span-8">
                            @livewire('charts.last-seven-day-chart')
                        </div>
                    </div>
                </div>
                <!-- End Tab Content 1 -->
            </div>

            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative" x-cloak>
                <!-- Tab Content 2 - Replace with your content -->
                <div class="mt-5">
                    @livewire('dashboard.productivity')
                </div>
                <!-- End Tab Content 2 -->
            </div>

            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative" x-cloak>
                <!-- Tab Content 3 - Replace with your content -->
                @livewire('dashboard.breakdown')
                <!-- End Tab Content 2 -->
            </div>
        </div>
    </div>



</x-admin-layout>
