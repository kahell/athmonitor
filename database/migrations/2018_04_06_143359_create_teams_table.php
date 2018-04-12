<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
          $table->bigIncrements('team_id');
          $table->string('name');
          $table->string('avatar')->nullable();
          $table->text('description')->nullable();
          $table->string('address')->nullable();
          $table->string('city')->nullable();
          $table->string('province')->nullable();
          $table->string('achieve_key')->nullable();
          $table->bigInteger('coach_id')->unsigned()->nullable()->index();
          $table->foreign('coach_id')->references('coach_id')->on('coaches')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('teams');
    }
}
