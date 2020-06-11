<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->text(10),
        'user_id'=>$faker->randomNumber(4),
        'commentable_type'=>$faker->text(10),
        'commentable_id'=>$faker->randomNumber(4),
    ];
});
