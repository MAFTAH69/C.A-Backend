<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'first_name',
        'second_name',
        'surname',
        'reg_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Relations
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function postponements()
    {
        return $this->hasMany(Postponement::class);
    }

    public function courseworks()
    {
        return $this->hasMany(Coursework::class);
    }
}
