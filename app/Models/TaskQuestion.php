<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskQuestion extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function scopeOfThis($query,$taskId)
    {
        return $query->where('task_id',$taskId);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class,'question_id');
    }
}
