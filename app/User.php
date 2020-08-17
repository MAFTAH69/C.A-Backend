<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;


    protected $fillable = [
        'first_name',
        'middle_name',
        'surname',
        'reg_number',
        'department',
        'program',
        'year',
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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    // Relations
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function postponements()
    {
        return $this->hasMany(Postponement::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function courseworks()
    {
        return $this->hasMany(Coursework::class);
    }
}
