<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Rate;
use Faker\Generator as Faker;

$factory->define(Rate::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->random()->id,
        'homework_id' => \App\Homework::all()->random()->id,
        'value' => $faker->numberBetween(1,5)
    ];
});
