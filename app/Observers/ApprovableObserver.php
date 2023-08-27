<?php

namespace App\Observers;
use Cjmellor\Approval\Models\Approval;

class ApprovableObserver
{
    public function creating(Approval $model)
    {
        $model->user_id = auth()->user()->id;
    } 
}
