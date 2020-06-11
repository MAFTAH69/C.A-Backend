<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;
use App\Practical;
use Faker\Generator as Faker;

$factory->define(Practical::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),
        'scored_marks' => $faker->randomNumber(2),

    ];
});
