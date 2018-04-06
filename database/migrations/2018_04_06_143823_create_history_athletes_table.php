<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryAthletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_athletes', function (Blueprint $table) {
          $table->bigIncrements('history_athlete_id');
          $table->unsignedBigInteger('athlete_id')->index();
          $table->foreign('athlete_id')->references('athlete_id')->on('athletes')->onDelete('cascade')->onUpdate('cascade');
          $table->bigInteger('team_id')->unsigned()->nullable();
          $table->foreign('team_id')->references('team_id')->on('teams')->onDelete('set null')->onUpdate('cascade');
          $table->dateTime('started_date');
          $table->dateTime('end_date');
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
        Schema::dropIfExists('history_athletes');
    }
}
