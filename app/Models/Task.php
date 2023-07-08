<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function taskQuestions()
    {
        return $this->hasMany(TaskQuestion::class);
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
