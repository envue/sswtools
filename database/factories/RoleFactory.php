<?php

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "price" => $faker->randomNumber(2),
        "stripe_plan_id" => $faker->name,
    ];
});
