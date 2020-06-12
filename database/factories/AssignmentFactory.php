<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;

use App\Assignment;
use Faker\Generator as Faker;

$factory->define(Assignment::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),
        'total_marks'=>$faker->randomNumber(2),
        'course_id'=>$faker->randomNumber(4)
          ];
});
