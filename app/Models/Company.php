<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_companies');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function segments()
    {
        return $this->hasMany(Segment::class);
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }
}
