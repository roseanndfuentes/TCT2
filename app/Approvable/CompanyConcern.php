<?php

namespace App\Approvable;
use App\Models\Approval;


class CompanyConcern 
{
      public static function requestForCompanyAccess($action,$modelId) : void
      {
            Approval::create([
                  'module'=>'COMPANY',
                  'model_id'=>$modelId,
                  'requestor_by_id'=>auth()->user()->id,
                  'action'=>$action
            ]);
      }


      public static function canEditCompany($modelId) : bool
      {
           return auth()->user()->for_approvals()->where('module','COMPANY')
            ->where('status','PENDING')
            ->whereNull('approved_at')
            ->where('model_id',$modelId->id)
            ->exist();
      }
}
