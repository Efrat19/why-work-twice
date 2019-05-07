<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name');
        });

       $this->insertBasic();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
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
