<?php

namespace App\Http\Livewire\Billings;

use App\Models\Category;
use App\Models\Company;
use App\Models\Form;
use App\Models\Task;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;

    public $c_id;

    public $y;

    public $m;

    public $yearList = [];

    public $monthList = [];

    public $editMinimumConsumableFeeHeaderModal = false;

    public $editBasicDiligenceHeaderModal = false;

    public $consumable_header_title = '';

    public $basic_diligence_header_title = '';

    public $queryString = [
        'c_id' => ['except' => ''],
        'y' => ['except' => ''],
        'm' => ['except' => ''],
    ];

    public $data = [
        'per_company_in_review' => 0,
        'dvr_one' => 0,
        'dvr_two' => 0,
        'dvr_three' => 0,
    ];

    public $companies = [];

    public $company = null;

    public $forms = [];

    public $categories = [];

    public $tasks = [];

    public $headers = [
        'basic_document_due_diligence_header' => '',
        'monthly_minimum_fee_header' => '',
    ];

    public function mount()
    {
        $this->companies = Company::all();
        $this->yearList = range(2035, 2023);
        $this->y = date('Y');
        $this->m = date('m');

        if ($this->c_id) {
            $this->company = Company::find($this->c_id);
            if ($this->company) {
                $this->tasks = Task::where('category_id', '!=', '')->whereHas('segment', function ($query) {
                    $query->where('company_id', $this->company->id);
                })->get();
                $this->getSubmissionDetails();
            }
        }

        $this->categories = Category::all();
    }

    public function render()
    {
        if ($this->company) {
            $this->headers['basic_document_due_diligence_header'] = $this->company->basic_document_due_diligence_header;
            $this->headers['monthly_minimum_fee_header'] = $this->company->monthly_minimum_fee_header;
        }

        return view('livewire.billings.index');
    }

    public function loadReport()
    {
        if (! $this->c_id) {
            $this->dialog()->error('Please select a company');

            return;
        }

        $this->company = Company::find($this->c_id);
        if ($this->company) {
            $this->tasks = Task::whereHas('segment', function ($query) {
                $query->where('company_id', $this->company->id);
            })->get();
            $this->getSubmissionDetails();
        }
    }

    public function getSubmissionDetails()
    {
        $this->forms = Form::where('company_id', $this->company->id)
            ->where('status', 'submitted')
            ->whereYear('created_at', $this->y)
            ->whereMonth('created_at', $this->m)
            ->with(['task'])
            ->get();
        $per_review = $this->forms->where('task.count_per_company_review', 1)->count();
        $dvr_count = $this->forms->where('initial_review', 0)->count();

        $this->data['per_company_in_review'] = $per_review;
        $this->data['dvr_one'] = $dvr_count > 60 ? 60 : $dvr_count;
        if($dvr_count > 60){
            $this->data['dvr_two'] > 150 ? 89 : $dvr_count - 60;
        }else{
            $this->data['dvr_two'] = 0;
        }
        if($dvr_count > 150){
            $this->data['dvr_three'] =$dvr_count;
        }else{
            $this->data['dvr_three'] = 0;
        }
    }

    public function updateConsumableHeader()
    {
        $this->validate([
            'consumable_header_title' => 'required',
        ]);
        $this->company->update([
            'monthly_minimum_fee_header' => $this->consumable_header_title,
        ]);
        $this->editMinimumConsumableFeeHeaderModal = false;
        $this->headers['monthly_minimum_fee_header'] = $this->consumable_header_title;
        $this->dialog()->success('Updated successfully');
    }

    public function updateBasicDiligenceHeader()
    {
        $this->validate([
            'basic_diligence_header_title' => 'required',
        ]);
        $this->company->update([
            'basic_document_due_diligence_header' => $this->basic_diligence_header_title,
        ]);
        $this->editBasicDiligenceHeaderModal = false;
        $this->headers['basic_document_due_diligence_header'] = $this->basic_diligence_header_title;
        $this->dialog()->success('Updated successfully');
    }
}
