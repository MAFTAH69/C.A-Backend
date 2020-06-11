<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;

use App\Letter;
use Faker\Generator as Faker;

$factory->define(Letter::class, function (Faker $faker) {
    return [
        'tittle' => $faker->text(10),
        'sample'=>$faker->text(20),
          ];
});
