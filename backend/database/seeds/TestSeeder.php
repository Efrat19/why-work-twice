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
    protected $seederStore;
    protected $faker;

    public function __construct(\App\Services\SeederStore $seederStore, \Faker\Generator $faker)
    {
        $this->seederStore = $seederStore;
        $this->faker = $faker;

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
            'homework_subject' => ['getRandomHomeworksId','getRandomSubjectsId','homework_id','subject_id'],
            'school_teacher' => ['getRandomSchoolsId','getRandomTeachersId','school_id','teacher_id'],
            'subject_teacher' => ['getRandomSubjectsId','getRandomTeachersId','subject_id','teacher_id'],
        ];

        $this->bulkSize = 1000;
    }

    public function run()
    {

        $this->collectGarbage();
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
        $this->seederStore->updateSchools();
        $this->seederStore->updateSubjects();
        $this->seederStore->updateTeachers();
        $this->populateUsersTable();
        $this->seederStore->updateUsers();
        $this->seederStore->updateSchools();
        $this->seederStore->updateSubjects();
        $this->seederStore->updateTeachers();
        $this->populateHomeworksTable();
        $this->seederStore->updateHomeworks();
        $this->populateCommentsTable();
        $this->populateRatesTable();
    }

    public function populateUsersTable()
    {
        $this->command->info('seeding users table:');
        $iters = $this->size['users'] / $this->bulkSize;
        $count = 0;
        while ($count != $iters)
        {
            $count ++;
            $this->command->info('inserting bulk '.$count.' out of '.$iters.'...');
            $bulk = $this->getUserBulk();
            DB::table('users')->insert($bulk);
            $this->collectGarbage();
        }
    }
    public function populateHomeworksTable()
    {
        $this->command->info('seeding homeworks table:');
        $iters = $this->size['homeworks'] / $this->bulkSize;
        $count = 0;
        while ($count != $iters)
        {
            $count ++;
            $this->command->info('inserting bulk '.$count.' out of '.$iters.'...');
            $bulk = $this->getHomeworkBulk();
            DB::table('homeworks')->insert($bulk);
            $this->collectGarbage();
        }
    }
    public function populateCommentsTable()
    {
        $this->command->info('seeding comments table:');
        $iters = $this->size['comments'] / $this->bulkSize;
        $count = 0;
        while ($count != $iters)
        {
            $count ++;
            $this->command->info('inserting bulk '.$count.' out of '.$iters.'...');
            $bulk = $this->getCommentBulk();
            DB::table('comments')->insert($bulk);
            $this->collectGarbage();
        }
    }
    public function populateRatesTable()
    {
        $this->command->info('seeding rates table:');
        $iters = $this->size['rates'] / $this->bulkSize;
        $count = 0;
        while ($count != $iters)
        {
            $count ++;
            $this->command->info('inserting bulk '.$count.' out of '.$iters.'...');
            $bulk = $this->getRateBulk();
            DB::table('rates')->insert($bulk);
            $this->collectGarbage();
        }
    }

    protected function collectGarbage()
    {
        $memory = (int)((memory_get_usage()/1024/1024));
        $this->command->alert('memory usage: '.$memory);
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
                $key1 => $this->seederStore->{$class1}(),
                $key2 => $this->seederStore->{$class2}(),
            ];
            $count ++ ;
        }
        return $bulk;
    }

    protected function getUserBulk()
    {
        $bulk = [];
        $count = 0;
        while ($count !== $this->bulkSize){
            $bulk[] = [
                'name' => $this->faker->name,
                'email' => \Illuminate\Support\Str::random(10).$this->faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'school_id' => $this->seederStore->getRandomSchoolsId(),
                'teacher_id' =>
                    $this->seederStore->getRandomTeachersId(),
                'subject_id' =>
                    $this->seederStore->getRandomSubjectsId(),
            ];
            $count ++ ;
        }
        return $bulk;
    }

    protected function getHomeworkBulk()
    {
        $bulk = [];
        $count = 0;
        while ($count !== $this->bulkSize){
            $bulk[] = [
                'school_id' => $this->seederStore->getRandomSchoolsId(),
                'teacher_id' =>  $this->seederStore->getRandomTeachersId(),
                'user_id' =>  $this->seederStore->getRandomUsersId(),
                'source' => \Illuminate\Support\Str::random(10),
                'description' => $this->faker->sentence(4),
                'views' => $this->faker->numberBetween(0, 1000000),
                'downloads' => $this->faker->numberBetween(0, 1000000)
            ];
            $count ++ ;
        }
        return $bulk;
    }

    protected function getCommentBulk()
    {
        $bulk = [];
        $count = 0;
        while ($count !== $this->bulkSize){
            $bulk[] = [
                'user_id' => $this->seederStore->getRandomUsersId(),
                'homework_id' => $this->seederStore->getRandomHomeworksId(),
                'header' => $this->faker->sentence(3),
                'body' => $this->faker->sentence($this->faker->numberBetween(5,15))
            ];
            $count ++ ;
        }
        return $bulk;
    }

    protected function getRateBulk()
    {
        $bulk = [];
        $count = 0;
        while ($count !== $this->bulkSize){
            $bulk[] = [
                'user_id' => $this->seederStore->getRandomUsersId(),
                'homework_id' => $this->seederStore->getRandomHomeworksId(),
                'value' => $this->faker->numberBetween(1,5)
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
