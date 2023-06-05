<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function question()
    {
        return $this->belongsTo(TaskQuestion::class,'question_id');
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
