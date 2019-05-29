<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Homework;
use Faker\Generator as Faker;



$factory->define(Homework::class, function (Faker $faker){
    $seederStore = app()->get('App\Services\SeederStore');
    return [
        'school_id' => $seederStore->getRandomSchoolsId(),
        'teacher_id' =>  $seederStore->getRandomTeachersId(),
        'user_id' =>  $seederStore->getRandomUsersId(),
        'source' => \Illuminate\Support\Str::random(10),
        'description' => $faker->sentence(4),
        'views' => $faker->numberBetween(0, 1000000),
        'downloads' => $faker->numberBetween(0, 1000000)
    ];
});
