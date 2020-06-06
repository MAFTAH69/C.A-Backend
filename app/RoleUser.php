<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'role_id'
    ];
    protected $dates = [
        'deleted_at'
    ];
}
