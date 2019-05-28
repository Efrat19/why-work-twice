<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $size;
    protected $pivotTables;
    protected $bulkSize;

    public function __construct()
    {
        $this->size = [
            'users' => 10,
            'homeworks' => 10,
            'comments' => 10,
            'rates' => 10,
            'homework_subject' => 10,
            'school_teacher' => 10,
            'subject_teacher' => 10,
        ];


        $this->pivotTables = [
            'homework_subject' => [\App\Homework::class,\App\Subject::class,'homework_id','subject_id'],
            'school_teacher' => [\App\School::class,\App\Teacher::class,'school_id','teacher_id'],
            'subject_teacher' => [\App\Subject::class,\App\Teacher::class,'subject_id','teacher_id'],
        ];

        $this->bulkSize = 1000;
    }

    public function run()
    {
        foreach ($this->size as $table => $size) {
            $newsize = $this->command->ask('how many records you want in '.$table.'?',$size);
            $this->size[$table] = (int)$newsize;
        }
        $confirmation = $this->calculateRowNum().' rows will be inserted into the database. bulksize:'.$this->bulkSize.' continue? y/n';
        $input = $this->command->ask($confirmation);
        if($input === 'y'){
            $this->seed();
        }
        $this->command->alert('quiting');
    }

    protected function seed()
    {
        $this->command->comment('show time!!!!');
        $this->runFactories();
        $this->fillPivotTables();
        $this->command->info('all done :)');
    }

    protected function runFactories()
    {
        $this->command->info('running factories....');
        $this->runHlperFactories();
        $this->command->info('seeding users table...');
        factory(App\User::class, $this->size['users'])->create();
        $this->command->info('seeding homeworks table...');
        factory(App\Homework::class, $this->size['homeworks'])->create();
        $this->command->info('seeding comments table...');
        factory(App\Comment::class, $this->size['comments'])->create();
        $this->command->info('seeding rates table...');
        factory(App\Rate::class, $this->size['rates'])->create();
    }


    protected function runHlperFactories()
    {
        $this->command->info('seeding helper tables...');
        factory(App\Teacher::class, 3)->create();
        factory(App\Subject::class, 3)->create();
        factory(App\School::class, 3)->create();
    }


    protected function fillPivotTables()
    {
        $this->command->info('seeding pivot tables...');
        foreach ($this->pivotTables as $pivot => $args) {
            $this->command->info('seeding '.$pivot.' table:');
            $iters = $this->size[$pivot] / $this->bulkSize;
            $count = 0;
            while ($count != $iters)
            {
                $this->command->info('inserting bulk '.$count.' out of '.$iters.'...');
                DB::table($pivot)->insert($this->getPivotBulk(...$args));
                $count ++;
            }
        }
    }

    protected function getPivotBulk($class1,$class2,$key1,$key2)
    {
        $bulk = [];
        $count = 0;
        while ($count !== $this->bulkSize){
            $bulk[] = [
                $key1 => $class1::all()->random()->id,
                $key2 => $class2::all()->random()->id
            ];
            $count ++ ;
        }
        return $bulk;

    }

    protected function calculateRowNum()
    {
        $sum = 0;
        foreach ($this->size as $table => $size) {
            $sum += $size;
        }
        return $sum;
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
//    $teacher->schools()->sync(\App\School::all()->random($faker->numberBetween(1,3)));
//});
