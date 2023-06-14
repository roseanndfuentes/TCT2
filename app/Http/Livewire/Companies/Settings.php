<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;
use WireUi\Traits\Actions;
class Settings extends Component
{
    use Actions;
    public $company;

    public $per_company_in_review_amount;
    public $per_unit_amount;

    public function mount($companyId)
    {
        abort_unless(auth()->user()->can('edit company setting'), 403, 'You are not authorized to edit company setting');
        $this->company = Company::findOrfail($companyId);
    }
    public function render()
    {   
        if ($this->company) {
            $this->per_company_in_review_amount = $this->company->per_company_in_review_amount;
            $this->per_unit_amount = $this->company->per_unit_work_amount;
        }
        return view('livewire.companies.settings');
    }

    public function updateStatus()
    {
        $this->company->update(['is_active' => !$this->company->is_active]);
        $this->company->refresh();
        $this->notification()->success('Company status updated successfully');
    }

    public function updatePercompanyInReviewAmount()
    {
        $this->company->update(['per_company_in_review_amount' => $this->per_company_in_review_amount]);
        $this->company->refresh();
        $this->notification()->success('Per company in review amount updated successfully');
    }

    public function updatePerUnitAmount()
    {
        $this->company->update(['per_unit_work_amount' => $this->per_unit_amount]);
        $this->company->refresh();
        $this->notification()->success('Per unit work amount updated successfully');
    }

}
