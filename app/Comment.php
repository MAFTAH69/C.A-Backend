<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'body',
        'postponement_id'
    ];
    protected $dates = [
        'deleted_at'
    ];
}
