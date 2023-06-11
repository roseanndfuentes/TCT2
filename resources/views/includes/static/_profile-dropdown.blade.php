<div x-data="{ isOpen: false }" class="relative" x-on:click.away="isOpen=false">
    <button x-on:click="isOpen = !isOpen" type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button"
        aria-expanded="false" aria-haspopup="true">
        <span class="sr-only">Open user menu</span>
        <img class="h-8 w-8 rounded-full bg-gray-50"
            src="https://ui-avatars.com/api/?background=5428e0&color=fff&name={{ auth()->user()->name }}"
            alt="">
        <span class="hidden lg:flex lg:items-center">
            <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">
                {{ auth()->user()->name }}
            </span>
            <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
            </svg>
        </span>
    </button>
    <div x-cloak x-show="isOpen" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 z-10 mt-1.5 w-40 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
        <div class="px-4 py-1" role="none">
            <p class="text-sm" role="none">Signed in as</p>
            <p class="truncate text-sm font-medium text-gray-900" role="none">
                {{ auth()->user()->email }}
            </p>
        </div>
        <div class="py-1" role="none">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem"
                    tabindex="-1"
                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    {{ __('Sign out') }}
                </a>
            </form>
        </div>
    </div>
</div>
