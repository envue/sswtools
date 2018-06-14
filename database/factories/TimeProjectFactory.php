<?php

$factory->define(App\TimeProject::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
