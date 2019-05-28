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
            'users' => 10000,
            'homeworks' => 100000,
            'comments' => 300000,
            'rates' => 3000000,
            'homework_subject' => 30000,
            'school_teacher' => 1000,
            'subject_teacher' => 1000,
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
        DB::connection()->disableQueryLog();
        $this->command->info('running factories....');
        $this->runHlperFactories();
        $this->runFactory(\App\User::class,'users');
        $this->runFactory(\App\Homework::class,'homeworks');
        $this->runFactory(\App\Comment::class,'comments');
        $this->runFactory(\App\Rate::class,'rates');
    }


    protected function runFactory($class,$table)
    {
        $this->command->info('seeding '.$table.' table...');
        $iters = $this->size[$table] / $this->bulkSize;
        $count = 0;
        while ($count != $iters)
        {
            $count ++;
            $this->command->info('inserting bulk '.$count.' out of '.$iters.'...');
            factory($class,$this->bulkSize)->create();
            $this->collectGarbage();
        }
    }

    protected function collectGarbage()
    {
        if (! gc_enabled()){
            gc_enable();
            $this->command->info('enabling garbage collector');
        }
        $collected = gc_collect_cycles();
        return $collected ?? $this->command->alert($collected.' cycles collected');
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
                $count ++;
                $this->command->info('inserting bulk '.$count.' out of '.$iters.'...');
                DB::table($pivot)->insert($this->getPivotBulk(...$args));
                $this->collectGarbage();
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
