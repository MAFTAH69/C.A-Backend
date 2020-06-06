<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'course_id',
        'marks',
        'scoreable_type',
        'scoreable_id'
    ];
    protected $dates = [
        'deleted_at'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function scorable()
    {
        return $this->morphTo();
    }
}
