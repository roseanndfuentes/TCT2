<div x-data="{
    users: [],
    searching: false,
    getUsers() {
        this.searching = true;
        fetch('/api/search-user?search=' + this.searchUser)
            .then(response => response.json())
            .then(data => {
                this.users = data
            })
            .catch(error => {
                console.log(error);
            })
            .finally(() => {
                this.searching = false;
            })
    },
    searchIsOpen: false,
    searchUser: '',
}" x-init="$watch('searchUser', (value) => {
    getUsers();
});">
    <div class="flex justify-between items-center ">
        <div class="relative" x-on:click.away="searchIsOpen=false">
            <x-text-input x-on:focus="searchIsOpen=true" x-model.debounce.500ms="searchUser" type="search" class="w-80"
                placeholder="Search" />
            <div x-cloak x-show="searchIsOpen"
                class="absolute rounded-xl z-40 shadow-lg  bg-white overflow-hidden border  flex-col  w-[500px]  mt-1 ">
                <div>
                    <template x-for="(user,index) in users" :key="user.id">
                        <div x-show="!searching" class="cursor-pointer group">
                            <button x-text="user.name" type="button"
                                x-on:click="$wire.selectUser(user.id); searchIsOpen=false"
                                class="block p-2 text-start w-full border-transparent border-l-4 group-hover:border-blue-600 group-hover:bg-gray-100">
                            </button>
                        </div>
                    </template>
                    <template x-if="users.length == 0 && !searching">
                        <div class="cursor-pointer group">
                            <a x-cloak x-show="searchUser.length > 2"
                                class="block p-2 border-transparent border-l-4 group-hover:border-blue-600 group-hover:bg-gray-100">
                                No results found for "<span x-text="searchUser"></span>"
                            </a>
                            <a x-cloak x-show="searchUser.length < 3"
                                class="block p-2 border-transparent border-l-4 group-hover:border-blue-600 group-hover:bg-gray-100">
                                Search for users
                            </a>
                        </div>
                    </template>

                    <template x-if="searching">
                        <div class="cursor-pointer group">
                            <a
                                class="block p-2 border-transparent border-l-4 group-hover:border-blue-600 group-hover:bg-gray-100">
                                Searching for "<span x-text="searchUser"></span>"
                            </a>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div class="flex space-x-3 items-center">
            <div class="flex items-center space-x-5 ">
                <div class="flex items-center space-x-1">
                    <span>Workweek Start : </span>
                    <x-text-input wire:model="weekStart" type="date" />
                </div>
                <div class="flex items-center space-x-1">
                    <span>Workweek End : </span>
                    <x-text-input wire:model="weekEnd" type="date" />
                </div>
                <div class="flex items-center space-x-1">
                    <span>Workweek No. : </span>
                    <span class="font-semibold border-0 ring-0 focus:ring-0 focus:border-0">
                        {{ $weekNo }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        @include('includes.partials._productivity-report')
        <div>
            @include('includes.modals._admin-productivity-selection')
        </div>
    </div>
</div>
