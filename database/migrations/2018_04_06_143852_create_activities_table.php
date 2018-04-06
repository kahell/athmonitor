<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
          $table->bigIncrements('activity_id');
          $table->bigInteger('team_id')->unsigned()->nullable();
          $table->foreign('team_id')->references('team_id')->on('teams')->onDelete('set null')->onUpdate('cascade');
          $table->dateTime('time')->nullable();
          $table->string('place');
          $table->enum('type', ['exercise', 'championship','sparing']);
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
        Schema::dropIfExists('activities');
    }
}
