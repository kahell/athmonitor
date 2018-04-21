<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryCoachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_coaches', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('coach_id')->index();
          $table->foreign('coach_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $table->bigInteger('team_id')->unsigned()->nullable()->undex();
          $table->foreign('team_id')->references('id')->on('teams')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('history_coaches');
    }
}
