<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Letter extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'sample',

    ];
    protected $dates = [
        'deleted_at'
    ];
}
