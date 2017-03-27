<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned()->index();
            
            $table->string('identity_code');
            $table->string('title');
            $table->text('description');
            $table->timestamp('award_on');

            $table->enum('duration_type', ['hour', 'day', 'month'])->default('day');
            $table->tinyInteger('duration_length');
            $table->string('status'); //available
            
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
        Schema::dropIfExists('project');
    }
}
