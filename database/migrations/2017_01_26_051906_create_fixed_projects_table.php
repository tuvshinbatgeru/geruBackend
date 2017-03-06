<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixedProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type'); //0 custom 0 < other 
            $table->string('unit'); //MNT, USD etc
            $table->decimal('min_amount', 18, 0);
            $table->decimal('max_amount', 18, 0);
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
        Schema::dropIfExists('fixed_projects');
    }
}
