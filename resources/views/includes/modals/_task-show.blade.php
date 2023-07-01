<x-modal.card title="Show Task" wire:model.defer="showTaskModal" maxWidth="3xl">
    <div>
        @if ($showTask)
            <table class="min-w-full bg-white border rounded-lg">
                <tbody>
                    <tr>
                        <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                            Company Name
                        </td>
                        <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            {{ $company->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                            Task Name
                        </td>
                        <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            {{ $showTask->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                            Amount
                        </td>
                        <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            {{ $showTask->amount }}
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                            Segment
                        </td>
                        <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            {{ $showTask->segment->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                            Category
                        </td>
                        <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            <x-badge>
                                {{ $showTask->category ? $showTask->category->name : 'N/A' }}
                            </x-badge>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                            Ref (Document Validation)
                        </td>
                        <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            {{ $showTask->is_document_review_reference ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                            Ref (Per Company In Review)
                        </td>
                        <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            {{ $showTask->count_per_company_review ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                            Ref (Start Review)
                        </td>
                        <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            {{ $showTask->review_starter ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                            Creator
                        </td>
                        <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            {{ $showTask->creator->email }}
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 font-bold text-gray-700 border border-gray-200">
                            Created At
                        </td>
                        <td class="py-2 px-4 text-gray-500 border border-gray-200">
                            {{ $showTask->created_at->format('Y-m-d') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>
</x-modal.card>
