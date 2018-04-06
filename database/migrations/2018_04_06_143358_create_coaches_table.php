<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaches', function (Blueprint $table) {
          $table->bigIncrements('coach_id');
          $table->unsignedBigInteger('user_id')->index();
          $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $table->bigInteger('sport_id')->unsigned()->nullable();
          $table->foreign('sport_id')->references('sport_id')->on('sports')->onDelete('set null')->onUpdate('cascade');
          $table->bigInteger('achieve_id')->unsigned()->nullable()->index();
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
        Schema::dropIfExists('coaches');
    }
}
