<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
//            $table->string('api_token', 80)->after('password')->unique()->nullable()->default(null);
//            $table->rememberToken();
            $table->timestamps();
            $table->unsignedInteger('permission_id')->default(1);
            $table->unsignedInteger('school_id');
            $table->string('image')->nullable();
            $table->boolean('is_subscribed')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

}
