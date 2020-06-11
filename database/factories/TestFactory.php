<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;
use App\Test;
use Faker\Generator as Faker;

$factory->define(Test::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),
        'scored_marks' => $faker->randomNumber(2),

    ];
});
