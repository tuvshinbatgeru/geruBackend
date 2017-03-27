<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowcaseSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showcase_skills', function (Blueprint $table) {
            $table->integer('showcase_id')->unsigned()->index();
            $table->integer('skill_id')->unsigned()->index();

            $table->primary(['showcase_id', 'skill_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('showcase_skills');
    }
}
