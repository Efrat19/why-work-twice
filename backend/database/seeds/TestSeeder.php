<?php

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create();
        factory(App\Homework::class, 80)->create();
        factory(App\Comment::class, 200)->create();
        factory(App\Rate::class, 100)->create();
    }


}
//
//$factory->afterCreating(App\Homework::class, function (Homework $homework, Faker $faker) {
//    $homework->subjects()->sync(\App\Subject::all()->random($faker->numberBetween(1,6)));
//});
//
//$factory->afterCreating(App\Teacher::class, function (\App\Teacher $teacher, Faker $faker) {
//    $teacher->subjects()->sync(\App\Subject::all()->random($faker->numberBetween(1,7)));
//});
//
//$factory->afterCreating(App\Teacher::class, function (\App\Teacher $teacher, Faker $faker) {
//    $teacher->subjects()->sync(\App\Subject::all()->random($faker->numberBetween(1,7)));
//});
//
//$factory->afterCreating(App\Teacher::class, function (\App\Teacher $teacher, Faker $faker) {
//    $teacher->schools()->sync(\App\School::all()->random($faker->numberBetween(1,3)));
//});
