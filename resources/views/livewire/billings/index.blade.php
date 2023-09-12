@php
    $overAllTotal = 0;
@endphp

<div class="space-y-4" x-data="{
    printDiv(divId) {
        var divToPrint = document.getElementById(divId);
        var newWin = window.open('', '_blank');
        newWin.document.write(divToPrint.outerHTML);
        newWin.document.close();
        newWin.print();
    }
}">
    @if ($company)
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-indigo-600">
                {{ $company->name }}
            </h1>
            <div class="flex space-x-2 ">
                <x-secondary-button x-on:click="printDiv('printable')">
                    <div class="flex items-center">
                        Print PDF
                    </div>
                </x-secondary-button>
            </div>
        </div>
        <table id="printable" class="min-w-full bg-white border rounded-lg">
            @include('includes.partials.billing-report._main-header')
            <tbody>

                <x-report-sub-header modal-name="editMinimumConsumableFeeHeaderModal" allow-edit="true"
                    name="{{ $headers['monthly_minimum_fee_header'] }}" total="" />
                <tr>
                    <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                        <span class="ml-3">
                            Minimum Fee (Consumable)
                        </span>
                    </td>
                    <td class="py-2 px-4 text-gray-500 border border-gray-200">
                        @php
                            $overAllTotal = $overAllTotal + $company->minimum_consumable_fee;
                        @endphp
                        {{ number_format($company->minimum_consumable_fee, 2) }}
                    </td>
                    <td class="py-2 px-4 text-gray-500 border border-gray-200">
                    </td>
                    <td class="py-2 px-4 text-gray-500 border border-gray-200">
                    </td>
                    <td class="py-2 px-4 text-gray-500 border border-gray-200">
                    </td>
                </tr>
                <x-category-total total="{{ number_format($company->minimum_consumable_fee, 2) }}" />
                @include('includes.partials.billing-report._scaper')
                <x-report-sub-header modal-name="editBasicDiligenceHeaderModal" allow-edit="true"
                    name="{{ $headers['basic_document_due_diligence_header'] }}" total="" />
                @include('includes.partials.billing-report._basic-due-diligence')
                <x-category-total
                    total="{{ number_format($data['per_company_in_review'] * $company->per_company_in_review_amount + $data['dvr_one'] * $company->dvr_one + $data['dvr_two'] * $company->dvr_two + $data['dvr_three'] * $company->dvr_three, 2) }}" />
                @php
                    $companyTasks = $tasks->groupBy('category_id');
                @endphp
                @foreach ($companyTasks as $key => $companyTask)
                    @php
                        $total = 0;
                        $category = $categories->find($key);
                    @endphp
                    @if ($category)
                        <x-report-sub-header name="{{ $category?->name }}" total="" />
                        @if ($category->formula === 'per_unit_in_performed_task')
                            <tr>
                                <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                                    <span class="ml-3">
                                        per hour (Note: 1 unit = 10 minutes work)
                                    </span>
                                </td>
                                <td class="py-2 px-4 text-gray-500 border border-gray-200">
                                    {{ number_format($company->per_unit_work_amount, 2) }}
                                </td>
                                <td colspan="3" class="py-2 px-4 text-gray-500 border border-gray-200">
                                </td>
                            </tr>
                        @endif
                        @foreach ($companyTask as $task)
                            <tr>
                                <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                                    <span class="ml-3">
                                        {{ $task->name }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 text-gray-500 border border-gray-200">
                                    @if ($category->formula === 'per_performed_task')
                                        {{ number_format($task->amount, 2) }}
                                    @endif
                                </td>
                                <td class="py-2 px-4 text-gray-500 border border-gray-200">
                                    {{ $forms->where('task_id', $task->id)->count() }}
                                </td>
                                <td class="py-2 px-4 text-gray-500 border border-gray-200">
                                    @php
                                        $total_unit_count = $forms->where('task_id', $task->id)->sum('unit_count');
                                    @endphp
                                    @if ($category->formula === 'per_unit_in_performed_task')
                                        @php
                                            $taskTotal = $company->per_unit_work_amount * $total_unit_count;
                                            $total += $taskTotal;
                                        @endphp
                                        {{ number_format($taskTotal, 2) }}
                                    @elseif ($category->formula === 'per_performed_task')
                                        @php
                                            $taskTotal = $task->amount * $forms->where('task_id', $task->id)->count();
                                            $total += $taskTotal;
                                        @endphp
                                        {{ number_format($taskTotal, 2) }}
                                    @endif
                                </td>
                                <td class="py-2 px-4 text-gray-500 border border-gray-200">
                                </td>
                            </tr>
                        @endforeach
                        <x-category-total total="{{ $total }}" />
                        @php
                            $overAllTotal = $overAllTotal + $total;
                        @endphp
                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="py-3 px-4 font-bold text-indigo-700 border border-gray-200">
                        Overall Total
                    </td>
                    <td colspan="4" class="py-2 px-4 font-bold text-indigo-700 border border-gray-200">
                        {{ $overAllTotal }}
                    </td>
                </tr>
            </tfoot>
        </table>
    @else
        <div>
            @include('includes.partials._select-company-and-date')
        </div>
    @endif
    @include('includes.modals._consumable-fee-header-edit')
    @include('includes.modals._basic-diligence-header-edit')
</div>
