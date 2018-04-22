<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name');
          $table->bigInteger('coach_id')->unsigned()->nullable();
          $table->foreign('coach_id')->references('id')->on('coaches')->onDelete('cascade')->onUpdate('cascade');
          $table->bigInteger('athlete_id')->unsigned()->nullable();
          $table->foreign('athlete_id')->references('id')->on('athletes')->onDelete('cascade')->onUpdate('cascade');
          $table->bigInteger('team_id')->unsigned()->nullable();
          $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade')->onUpdate('cascade');
          $table->text('description')->nullable();
          $table->string('images')->nullable();
          $table->string('date')->nullable();
          $table->enum('level', ['local', 'regional', 'national', 'international']);
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
        Schema::dropIfExists('achievements');
    }
}
