<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;

use App\Year;
use Faker\Generator as Faker;

$factory->define(Year::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),

    ];
});
