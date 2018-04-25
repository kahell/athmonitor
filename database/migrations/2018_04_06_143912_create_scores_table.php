<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('parameter_id')->unsigned()->nullable();
          $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('set null')->onUpdate('cascade');
          $table->double('value');
          $table->bigInteger('athlete_id')->unsigned()->nullable();
          $table->foreign('athlete_id')->references('id')->on('athletes')->onDelete('cascade')->onUpdate('cascade');
          $table->bigInteger('activity_id')->unsigned()->nullable();
          $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('scores');
    }
}
