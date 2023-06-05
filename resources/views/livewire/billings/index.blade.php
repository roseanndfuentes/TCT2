<div class="space-y-4">
    @if ($company)
        <div>
            <h1 class="text-2xl font-semibold text-indigo-600">
                {{ $company->name }}
            </h1>
        </div>
        <table class="min-w-full bg-white border rounded-lg">
            @include('includes.partials.billing-report._main-header')
            <tbody>
                <x-report-sub-header name="OaaS Monthly Minimum Fee"
                    total="{{ number_format($company->minimum_consumable_fee, 2) }}" />
                <tr>
                    <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                        <span class="ml-3">
                            Minimum Fee (Consumable)
                        </span>
                    </td>
                    <td class="py-2 px-4 text-gray-500 border border-gray-200">
                        {{ number_format($company->minimum_consumable_fee, 2) }}
                    </td>
                    <td class="py-2 px-4 text-gray-500 border border-gray-200">
                    </td>
                    <td class="py-2 px-4 text-gray-500 border border-gray-200">
                    </td>
                    <td class="py-2 px-4 text-gray-500 border border-gray-200">
                    </td>
                </tr>
                @include('includes.partials.billing-report._scaper')
                <x-report-sub-header name="Basic Company Due Diligence" total="100.00" />
                @include('includes.partials.billing-report._basic-due-diligence')
                @php
                    $groupForms = $forms->groupBy('category_id');
                @endphp
                @foreach ($groupForms as $key => $forms)
                    <x-report-sub-header name="OaaS Monthly Minimum Fee "
                        total="{{ number_format($company->minimum_consumable_fee, 2) }}" />
                    @foreach ($forms as $form)
                        <tr>
                            <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                                <span class="ml-3">
                                    {{ $form->task->name }}
                                </span>
                            </td>
                            <td class="py-2 px-4 text-gray-500 border border-gray-200">
                                {{ number_format($company->minimum_consumable_fee, 2) }}
                            </td>
                            <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            </td>
                            <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            </td>
                            <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @else
        <div>
            @include('includes.partials._select-company-and-date')
        </div>
    @endif
</div>
