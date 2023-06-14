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

            <div id="3120aijwdo892130821jhnjkl" class="p-3 bg-gray-100 rounded-lg border">
                <div class="flex justify-between items-center">
                    <div>
                        <x-input-label for="campany_in_review_amount" value="Per in review amount" />
                        <div class="mt-1">
                            <x-text-input wire:model.defer="per_company_in_review_amount" id="campany_in_review_amount"
                                name="campany_in_review_amount" type="number" />
                        </div>
                    </div>
                    <div class="pt-7">
                        <button type="button"
                            x-on:confirm="{
                        title: 'Are you sure?',
                        description: 'This will change the per company in review amount.',
                        icon: 'warning',
                        method: 'updatePercompanyInReviewAmount',
                    }"
                            class="font-semibold text-indigo-600 hover:text-indigo-500">
                            <span wire:loading.remove wire:target="updatePercompanyInReviewAmount">Update</span>
                            <span wire:loading wire:target="updatePercompanyInReviewAmount">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 animate-spin h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <div id="daoi9213u79jdasd98729h" class="p-3 bg-gray-100 rounded-lg border">
                <div class="flex justify-between items-center">
                    <div>
                        <x-input-label for="per_unit_amount" value="Per unit amount" />
                        <div class="mt-1">
                            <x-text-input wire:model.defer="per_unit_amount" name="per_unit_amount" id="per_unit_amount"
                                type="number" />
                        </div>
                    </div>
                    <div class="pt-7">
                        <button type="button"
                            x-on:confirm="{
                        title: 'Are you sure?',
                        description: 'This will change the status of the company.',
                        icon: 'warning',
                        method: 'updatePerUnitAmount',
                    }"
                            class="font-semibold text-indigo-600 hover:text-indigo-500">
                            <span wire:loading.remove wire:target="updatePerUnitAmount">Update</span>
                            <span wire:loading wire:target="updatePerUnitAmount">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 animate-spin h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-tct.card>
</div>
