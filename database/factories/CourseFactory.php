<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'tittle' => $faker->text(10),
        'code'=>$faker->text(5),
          ];
});
