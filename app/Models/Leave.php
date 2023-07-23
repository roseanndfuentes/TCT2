<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TYPES = [
        'SICK_LEAVE' => 'Sick Leave',
        'VACTION_LEAVE' => 'Vacation Leave',
    ];

    const SHIFT = [
        'FULL_SHIFT' => 'Full Shift',
        'PARTIAL_SHIFT' => 'Partial Shift',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
