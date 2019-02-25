<?php

use Faker\Generator as Faker;

$factory->define(App\Player::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'goals' => $faker->numberBetween($min = 0, $max = 30),
        'assists' => $faker->numberBetween($min = 0, $max = 30),
        'points' => $faker->numberBetween($min = 0, $max = 30)
    ];
});
