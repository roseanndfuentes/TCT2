<div>
    <x-tct.card>
        <x-slot:header>
            <span class="text-lg">
                <span class="text-indigo-600 font-semibold">{{ $company->name }}</span> 's settings
            </span>
        </x-slot:header>
        <div class="space-y-3">
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">
                    Status
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-500">
                    Making a status active will make the company visible to drop down menus.
                </p>
                <ul role="list" class="mt-6 divide-y divide-gray-100 border-t border-gray-200 text-sm leading-6">
                    <li class="flex justify-between gap-x-6 py-6">
                        <div class="font-medium text-gray-900">
                            @if ($company->is_active)
                                <div class="flex space-x-2 items-center">
                                    <div class="h-4 w-4 rounded-full bg-green-600">
                                    </div> <span>Active</span>
                                </div>
                            @else
                                <div class="flex space-x-2 items-center">
                                    <div class="h-4 w-4 rounded-full bg-red-600">
                                    </div> <span>Inactive</span>
                                </div>
                            @endif
                        </div>
                        <button type="button"
                            x-on:confirm="{
                            title: 'Are you sure?',
                            description: 'This will change the status of the company.',
                            icon: 'warning',
                            method: 'updateStatus',
                        }"
                            class="font-semibold text-indigo-600 hover:text-indigo-500">
                            <span wire:loading.remove wire:target="updateStatus">Update</span>
                            <span wire:loading wire:target="updateStatus">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 animate-spin h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                            </span>
                        </button>
                    </li>
                </ul>
            </div>
            {{-- <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">
                    Preferences
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-500">

                </p>
                <dl class="mt-6 space-y-6 divide-y divide-gray-100 border-t border-gray-200 text-sm leading-6">
                    <div class="pt-6 sm:flex">
                        <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">Language</dt>
                        <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-900">English</div>
                            <button type="button"
                                class="font-semibold text-indigo-600 hover:text-indigo-500">Update</button>
                        </dd>
                    </div>
                    <div class="pt-6 sm:flex">
                        <dt class="font-medium text-gray-900 sm:w-64 sm:flex-none sm:pr-6">Date format</dt>
                        <dd class="mt-1 flex justify-between gap-x-6 sm:mt-0 sm:flex-auto">
                            <div class="text-gray-900">DD-MM-YYYY</div>
                            <button type="button"
                                class="font-semibold text-indigo-600 hover:text-indigo-500">Update</button>
                        </dd>
                    </div>
                    <div class="flex pt-6">
                        <dt class="w-64 flex-none pr-6 font-medium text-gray-900" id="timezone-option-label">
                            Automatic timezone</dt>
                        <dd class="flex flex-auto items-center justify-end">
                            <!-- Enabled: "bg-indigo-600", Not Enabled: "bg-gray-200" -->
                            <button type="button"
                                class="bg-gray-200 flex w-8 cursor-pointer rounded-full p-px ring-1 ring-inset ring-gray-900/5 transition-colors duration-200 ease-in-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                role="switch" aria-checked="true" aria-labelledby="timezone-option-label">
                                <!-- Enabled: "translate-x-3.5", Not Enabled: "translate-x-0" -->
                                <span aria-hidden="true"
                                    class="translate-x-0 h-4 w-4 transform rounded-full bg-white shadow-sm ring-1 ring-gray-900/5 transition duration-200 ease-in-out"></span>
                            </button>
                        </dd>
                    </div>
                </dl>
            </div> --}}
        </div>
    </x-tct.card>
</div>
