<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// use App\Model;

use App\Postponement;
use Faker\Generator as Faker;

$factory->define(Postponement::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomNumber(4),
        'attachement'=>$faker->text(20),
        'postponable_type'=>$faker->text(10),
        'posponable-id'=>$faker->randomNumber(4)
          ];
});
