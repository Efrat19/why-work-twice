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
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'school_id' => function () use ($faker) {
            return $faker->boolean(60) ?
                \App\School::all()->random()->id : factory(\App\School::class)->create()->id;
        },
        'teacher_id' => function () use ($faker) {
            return $faker->boolean(70) ?
                \App\Teacher::all()->random()->id : factory(\App\Teacher::class)->create()->id;
        },
        'subject_id' => function () use ($faker) {
            return $faker->boolean(80) ?
                \App\Subject::all()->random()->id : factory(\App\Subject::class)->create()->id;
        },
        'is_subscribed' => $faker->boolean,
    ];
});
