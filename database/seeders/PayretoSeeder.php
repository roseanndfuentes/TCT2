<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Segment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayretoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $technical_support = Segment::create([
            'name' => 'Technical Support',
            'company_id' => 1,
        ]);
    
        $task = $technical_support->tasks()->create([
            'name' => 'Break',
            'created_by' => 1,
            'category_id'=> 1,
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'Choose Which Break',
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'Comments',
        ]);


        $task=$technical_support->tasks()->create([
            'name' => 'Internal Training',
            'created_by' => 1,
            'category_id'=> 1,
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'Training Title',
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'What kind of training is this?',
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'Are you an attendee or a trainor?',
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'Comment/s:',
        ]);

        $task = $technical_support->tasks()->create([
            'name' => 'External Training',
            'created_by' => 1,
            'category_id'=> 1,
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'Training Title',
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'Is this Client or Payreto Sponsored sponsored?',
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'If Client sponsored the training, which Client?',
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'General Comments',
        ]);

        $task = $technical_support->tasks()->create([
            'name' => 'Internal Meeting',
            'created_by' => 1,
            'category_id'=> 1,
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'Meeting Title',
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'What kind of meeting is this?',
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'Others - Please specify',
        ]);

        $task->taskQuestions()->create([
            'created_by'=>1,
            'message'=>'General Comments',
        ]);

        $technical_support->tasks()->create([
            'name' => 'Client Meeting',
            'created_by' => 1,
            'category_id'=> 1,
        ]);

        $technical_support->tasks()->create([
            'name' => 'Admin & Other Tasks',
            'created_by' => 1,
            'category_id'=> 1,
        ]);

        // -----------------------------------
        $onboarding = Segment::create([
            'name' => 'Onboarding',
            'company_id' => 1,
        ]);

        $onboarding->tasks()->create([
            'name' => 'Break',
            'created_by' => 1,
            'category_id'=> 1,
        ]);
        $onboarding->tasks()->create([
            'name' => 'Internal Training',
            'created_by' => 1,
            'category_id'=> 1,
        ]);
        $onboarding->tasks()->create([
            'name' => 'External Training',
            'created_by' => 1,
            'category_id'=> 1,
        ]);
        $onboarding->tasks()->create([
            'name' => 'Internal Meeting',
            'created_by' => 1,
            'category_id'=> 1,
        ]);
        $onboarding->tasks()->create([
            'name' => 'Client Meeting',
            'created_by' => 1,
            'category_id'=> 1,
        ]);
        $onboarding->tasks()->create([
            'name' => 'Admin & Other Tasks',
            'created_by' => 1,
            'category_id'=> 1,
        ]);

        $chargeback = Segment::create([
            'name' => 'Chargeback',
            'company_id' => 1,
        ]);

        $chargeback->tasks()->create([
            'name' => 'Break',
            'created_by' => 1,
            'category_id'=> 1,
        ]);
        $chargeback->tasks()->create([
            'name' => 'Internal Training',
            'created_by' => 1,
            'category_id'=> 1,
        ]);
        $chargeback->tasks()->create([
            'name' => 'External Training',
            'created_by' => 1,
            'category_id'=> 1,
        ]);
        $chargeback->tasks()->create([
            'name' => 'Internal Meeting',
            'created_by' => 1,
            'category_id'=> 1,
        ]);
        $chargeback->tasks()->create([
            'name' => 'Client Meeting',
            'created_by' => 1,
            'category_id'=> 1,
        ]);
        $chargeback->tasks()->create([
            'name' => 'Admin & Other Tasks',
            'created_by' => 1,
            'category_id'=> 1,
        ]);

    }
}
