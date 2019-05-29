<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all('id')->random()->id,
        'homework_id' => \App\Homework::all('id')->random()->id,
        'header' => $faker->sentence(3),
        'body' => $faker->sentence($faker->numberBetween(5,15))
    ];
});
