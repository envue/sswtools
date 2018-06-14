<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "email" => $faker->safeEmail,
        "password" => str_random(10),
        "role_id" => factory('App\Role')->create(),
        "team_id" => factory('App\Team')->create(),
        "remember_token" => $faker->name,
        "stripe_customer_id" => $faker->name,
        "role_until" => $faker->date("m/d/Y H:i:s", $max = 'now'),
    ];
});
