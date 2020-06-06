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
}
