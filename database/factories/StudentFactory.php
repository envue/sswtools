<?php

$factory->define(App\Student::class, function (Faker\Generator $faker) {
    return [
        "identifier" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
        "created_by_team_id" => factory('App\Team')->create(),
    ];
});
