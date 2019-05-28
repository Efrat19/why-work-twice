<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertBasic();

    }

    private function insertBasic(){
        DB::table('permissions')->insert(
            array(
                'name' => 'user',
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'moderator',
            )
        );
        DB::table('permissions')->insert(
            array(
                'name' => 'admin',
            )
        );
    }
}
