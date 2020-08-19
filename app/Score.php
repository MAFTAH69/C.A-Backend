<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reg_number',
        'scored_marks',
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
