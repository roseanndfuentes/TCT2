<?php

namespace App\Http\Livewire\Billings;

use App\Models\Form;
use App\Models\Company;
use Livewire\Component;
use App\Models\Category;
use App\Models\Task;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;

    public $c_id;
    public $y;
    public $m;



    public $yearList = [];
    public $monthList = [];

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

    public $company =null;

    public $forms =[];

    public $categories =[];

    public $tasks =[];

    
    public function mount()
    {
        $this->companies = Company::all();
        $this->yearList = range(2035, 2023);
        $this->y = date('Y');
        $this->m = date('m');

        if ($this->c_id) {
            $this->company = Company::find($this->c_id);
            if ($this->company) {
                $this->tasks = Task::whereHas('segment', function ($query) {
                    $query->where('company_id', $this->company->id);
                })->get();
                $this->getSubmissionDetails();
            }
        }

        $this->categories = Category::all();
    }
    public function render()
    {
        return view('livewire.billings.index');
    }

    public function loadReport()
    {
       if(!$this->c_id){
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
        $per_review = $this->forms->where('task.review_starter', 1)->count();

        $dvr_count = $this->forms->where('initial_review',0)->count();
    
        $this->data['per_company_in_review']  = $per_review;
        $this->data['dvr_one'] = $dvr_count > 0 && $dvr_count <= 60 ? $dvr_count : 0;
        $this->data['dvr_two'] = $dvr_count > 60 && $dvr_count <= 150 ? $dvr_count : 0;
        $this->data['dvr_three'] = $dvr_count > 150 && $dvr_count <= 400 ? $dvr_count : 0;
    }
}
