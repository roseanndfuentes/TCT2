<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    const FORMULAS = [
        'per_unit_in_performed_task' => 'Per Unit in Performed Task',
        'per_performed_task' => 'Per Performed Task',
    ];

    const PER_UNIT_IN_PERFORMED_TASK = 'per_unit_in_performed_task';

    const PER_PERFORMED_TASK = 'per_performed_task';

    protected $guarded = [];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'category_companies');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
