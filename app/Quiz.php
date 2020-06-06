<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function scores()
    {
        return $this->morphToMany(Score::class, 'scorable');
    }
}
