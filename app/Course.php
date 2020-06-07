<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'code',
        'title'
    ];
    protected $dates = [
        'deleted_at'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
    public function practicals()
    {
        return $this->hasMany(Practical::class);
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
