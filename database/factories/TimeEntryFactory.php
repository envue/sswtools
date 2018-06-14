<?php

$factory->define(App\TimeEntry::class, function (Faker\Generator $faker) {
    return [
        "start_time" => $faker->date("m/d/Y H:i:s", $max = 'now'),
        "end_time" => $faker->date("m/d/Y H:i:s", $max = 'now'),
        "work_type_id" => factory('App\TimeWorkType')->create(),
        "population_type" => collect(["1","2","3",])->random(),
        "caseload" => collect(["1","0","2",])->random(),
        "description" => $faker->name,
        "notes" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
        "created_by_team_id" => factory('App\Team')->create(),
    ];
});
