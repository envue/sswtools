<?php

$factory->define(App\TimeWorkType::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
