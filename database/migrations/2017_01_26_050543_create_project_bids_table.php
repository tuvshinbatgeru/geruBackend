<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_bids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->tinyInteger('charge_id')->default(0); //0 - Энгийн, 1 - Онцлосон 2 - Тухайн нтр
            $table->text('proposal');
            $table->decimal('price', 18, 0);
            $table->enum('duration_type', ['hour', 'day', 'month'])->default('day');
            $table->tinyInteger('duration_length');
            $table->timestamp('bid_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_bids');
    }
}
