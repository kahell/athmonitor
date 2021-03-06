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
          $table->bigIncrements('id');
          $table->string('name');
          $table->text('avatar')->nullable();
          $table->text('description')->nullable();
          $table->text('address')->nullable();
          $table->string('city')->nullable();
          $table->string('province')->nullable();
          $table->bigInteger('coach_id')->unsigned()->nullable()->index();
          $table->foreign('coach_id')->references('id')->on('coaches')->onDelete('cascade')->onUpdate('cascade');
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
