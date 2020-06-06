<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title'
    ];
    protected $dates = [
        'deleted_at'
    ];
}
