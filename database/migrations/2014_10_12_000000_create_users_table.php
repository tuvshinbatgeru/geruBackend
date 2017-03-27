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
            $table->increments('id');
            $table->string('username', 200);
            
            
            $table->string('socialite_id', 30)->nullable();
            $table->integer('socialite_type'); //1 - facebook

            $table->string('email')->nullable();
            $table->string('registry_no');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('avatar_url', 1000)->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->text('summery')->nullable();
            $table->string('password');
            $table->enum('is_active', ['N', 'Y', 'B']);
            //$table->enum('status', ['N' , 'Y'])->default('Y');
            $table->rememberToken();
            $table->timestamps();
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
