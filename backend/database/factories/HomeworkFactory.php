<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Homework;
use Faker\Generator as Faker;

$factory->define(Homework::class, function (Faker $faker) {
    return [

        'school_id' => function () {
            return \App\School::all()->random()->id;
        },
        'teacher_id' => function () {
            return \App\Teacher::all()->random()->id;
        },
        'user_id' => function () {
            return \App\User::all()->random()->id;
        },
        'source' => \Illuminate\Support\Str::random(10),
        'description' => $faker->sentence(4),
        'views' => $faker->numberBetween(0, 1000000),
        'downloads' => $faker->numberBetween(0, 1000000)
    ];
});
