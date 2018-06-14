<?php

$factory->define(App\UserProfile::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "num_schools" => $faker->randomNumber(2),
    ];
});
