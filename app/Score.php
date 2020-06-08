<?php

namespace App;
use App\Test;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'course_id',
        'marks',
        'scorable_type',
        'scorable_id'
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
