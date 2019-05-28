<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Homework;
use Faker\Generator as Faker;

$factory->define(Homework::class, function (Faker $faker) {
    return [

        'school_id' => function () {
            \App\School::all()->random()->id;
        },
        'teacher_id' => function () {
            \App\Teacher::all()->random()->id;
        },
        'user_id' => function () {
            \App\User::all()->random()->id;
        },
        'source' => $faker->file(),
        'description' => $faker->sentence(4),
        'views' => $faker->numberBetween(0, 1000000),
        'downloads' => $faker->numberBetween(0, 1000000)
    ];
});
