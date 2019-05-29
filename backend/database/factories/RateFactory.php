<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Rate;
use Faker\Generator as Faker;

$factory->define(Rate::class, function (Faker $faker) {
    $seederStore = app()->get('App\Services\SeederStore');
    return [
        'user_id' => $seederStore->getRandomUsersId(),
        'homework_id' => $seederStore->getRandomHomeworksId(),
        'value' => $faker->numberBetween(1,5)
    ];
});
