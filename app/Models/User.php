<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    public function created_categories()
    {
        return $this->hasMany(Category::class, 'created_by');
    }

    public function created_companies()
    {
        return $this->hasMany(Company::class, 'created_by');
    }

    public function created_tasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    public function created_task_questions()
    {
        return $this->hasMany(TaskQuestion::class, 'created_by');
    }

    public function submitted_forms()
    {
        return $this->hasMany(Form::class, 'submitted_by');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'created_by',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
