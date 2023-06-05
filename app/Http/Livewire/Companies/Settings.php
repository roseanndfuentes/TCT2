<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Livewire\Component;
use WireUi\Traits\Actions;
class Settings extends Component
{
    use Actions;
    public $company;

    public function mount($companyId)
    {
        abort_unless(auth()->user()->can('edit company setting'), 403, 'You are not authorized to edit company setting');
        $this->company = Company::findOrfail($companyId);
    }
    public function render()
    {
        return view('livewire.companies.settings');
    }

    public function updateStatus()
    {
        $this->company->update(['is_active' => !$this->company->is_active]);
        $this->company->refresh();
        $this->notification()->success('Company status updated successfully');
    }
}
