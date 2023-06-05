<tr>
    <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
        <span class="ml-3">
            per company in review
        </span>
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ number_format($company->per_company_in_review_amount, 2) }}
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ $data['per_company_in_review'] }}
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ number_format($data['per_company_in_review'] * $company->per_company_in_review_amount, 2) }}
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
    </td>
</tr>
<tr>
    <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
        <span class="ml-3">
            Document Validation Review
        </span>
    </td>
    <td colspan="4" class="py-2 px-4 text-gray-500 border border-gray-200">
    </td>
</tr>

<tr>
    <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
        <span class="ml-3">
            1-60
        </span>
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ $company->dvr_one }}
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ $data['dvr_one'] }}
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ number_format($data['dvr_one'] * $company->dvr_one, 2) }}
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
    </td>
</tr>
<tr>
    <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
        <span class="ml-3">
            61-150
        </span>
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ $company->dvr_two }}
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ $data['dvr_two'] }}
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ number_format($data['dvr_two'] * $company->dvr_two, 2) }}
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
    </td>
</tr>
<tr>
    <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
        <span class="ml-3">
            151-400
        </span>
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ $company->dvr_three }}
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ $data['dvr_three'] }}
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
        {{ number_format($data['dvr_three'] * $company->dvr_three, 2) }}
    </td>
    <td class="py-2 px-4 text-gray-500 border border-gray-200">
    </td>
</tr>
