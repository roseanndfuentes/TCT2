<div x-cloak x-show="mobileNav" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">

    <div x-cloak x-show="mobileNav" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80"></div>

    <div class="fixed inset-0 flex">

        <div x-cloak x-show="mobileNav" x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full" class="relative mr-16 flex w-full max-w-xs flex-1">
            <div x-cloak x-show="mobileNav" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                class="absolute left-full top-0 flex w-16 justify-center pt-5">
                <button x-on:click="mobileNav=false" type="button" class="-m-2.5 p-2.5">
                    <span class="sr-only">Close sidebar</span>
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-indigo-600 px-6 pb-4">
                <div class="flex items-center h-16 shrink-0">
                    <div class="w-full p-3 mt-5 rounded-lg">
                        <h1 class="text-4xl font-extrabold tracking-widest text-white">
                            TCT - APP
                        </h1>
                    </div>
                </div>
                @include('includes.static._sidebar-navs')
            </div>
        </div>
    </div>
</div>
