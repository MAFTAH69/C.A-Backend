<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;

use App\Assignment;
use Faker\Generator as Faker;

$factory->define(Assignment::class, function (Faker $faker) {
    return [
        'tittle' => $faker->text(10),
        'scored_marks'=>$faker->randomNumber(2),
          ];
});
