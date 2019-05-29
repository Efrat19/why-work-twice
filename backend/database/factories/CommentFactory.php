<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $seederStore = app()->get('App\Services\SeederStore');
    return [
        'user_id' => $seederStore->getRandomUsersId(),
        'homework_id' => $seederStore->getRandomHomeworksId(),
        'header' => $faker->sentence(3),
        'body' => $faker->sentence($faker->numberBetween(5,15))
    ];
});
