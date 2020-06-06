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
        'comentable_type',
        'commentable_id'
    ];
    protected $dates = [
        'deleted_at'
    ];
}
