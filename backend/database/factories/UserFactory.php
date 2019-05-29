<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {

    $seederStore = app()->get('App\Services\SeederStore');
    return [
        'name' => $faker->name,
        'email' => Str::random(10).$faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//        'remember_token' => Str::random(10),
        'school_id' => $seederStore->getRandomSchoolsId(),
        'teacher_id' =>
                    $seederStore->getRandomTeachersId(),
        'subject_id' =>
                    $seederStore->getRandomSubjectsId(),
//        'is_subscribed' => $faker->boolean,
    ];
});
