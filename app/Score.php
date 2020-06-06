<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'course_id',
        'marks',
        'scorable_type',
        'scorable_id'
    ];
    protected $dates = [
        'deleted_at'
    ];
}
