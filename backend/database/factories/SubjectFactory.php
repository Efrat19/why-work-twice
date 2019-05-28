<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => $faker->realText($faker->numberBetween(7,16)),
    ];
});
