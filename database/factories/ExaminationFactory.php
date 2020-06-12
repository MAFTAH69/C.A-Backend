<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;
use App\Examination;
use Faker\Generator as Faker;

$factory->define(Examination::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),

    ];
});
