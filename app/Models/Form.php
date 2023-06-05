<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $guarded=[];

    const STATUSES = [
        'in_progress'=>'In Progress',
        'paused'=>'Paused',
        'submitted'=>'Submitted',
    ];

    const IN_PROGRESS = 'in_progress';
    const PAUSED = 'paused';
    const SUBMITTED = 'submitted';

    public function submitter()
    {
        return $this->belongsTo(User::class,'submitted_by');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function scopePermisseble($query)
    {
        if (auth()->user()->can('view all submissions')) {
            return $query;
        }
        return $query->where('submitted_by', auth()->id());
    }

    public function isInProgress()
    {
        return $this->status == self::IN_PROGRESS;
    }

    public function isPaused()
    {
        return $this->status == self::PAUSED;
    }

    public function isSubmitted()
    {
        return $this->status == self::SUBMITTED;
    }

    public function pause()
    {
        $this->update([
            'status'=>self::PAUSED,
            'total_time_spent'=>$this->totalTimeSpentInSeconds(),
            'last_pause_time'=>now(),
            'pause_id' => $this->pause_id !='' ? $this->pause_id : $this->generatePausedId(),
        ]);
    }

    public function totalTimeSpentInSeconds()
    {
        if ($this->last_resume_time) {
            return $this->total_time_spent + now()->diffInSeconds(\Carbon\Carbon::parse($this->last_resume_time));
        }else{
            return $this->total_time_spent + now()->diffInSeconds(\Carbon\Carbon::parse($this->start_time));
        }
    }

    public function resume()
    {
        $this->update([
            'status'=>self::IN_PROGRESS,
            'last_resume_time'=>now(),
        ]);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function generatePausedId()
    {
        return \Carbon\Carbon::now()->format('Ymd').'-T-P'.str_pad($this->id, 10, '0', STR_PAD_LEFT);
    }

    public function submit()
    {
        $this->status = self::SUBMITTED;
        $this->end_time = now();
        $this->total_time_spent = $this->totalTimeSpentInSeconds();
        $this->unit_count = $this->getTotalUnit($this->total_time_spent);
        $this->save();
    }

    public function getTotalUnit($totalTimeSpendInSec)
    {
        return ceil($totalTimeSpendInSec/600);
    }
}
