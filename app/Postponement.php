<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postponement extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'attachement',
        'postponable_type',
        'postponable_id'
    ];
    protected $dates = [
        'deleted_at'

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
