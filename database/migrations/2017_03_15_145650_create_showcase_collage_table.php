<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowcaseCollageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showcase_collage', function (Blueprint $table) {
            $table->integer('showcase_id')->unsigned()->index();
            $table->integer('collage_id')->unsigned()->index();

            $table->primary(['showcase_id', 'collage_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('showcase_collage');
    }
}
