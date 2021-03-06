<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAthletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athletes', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('team_id')->unsigned()->nullable();
          $table->foreign('team_id')->references('id')->on('teams')->onDelete('set null')->onUpdate('cascade');
          $table->bigInteger('position_type_id')->unsigned()->nullable();
          $table->foreign('position_type_id')->references('id')->on('position_types')->onDelete('set null')->onUpdate('cascade');
          $table->string('fullname')->nullable();
          $table->enum('gender', ['man', 'woman']);
          $table->text('avatar')->nullable();
          $table->text('address')->nullable();
          $table->string('bod')->nullable();
          $table->string('phone_number')->unique();
          $table->integer('player_number')->nullable();
          $table->enum('player_status', ['active', 'inactive']);
          $table->enum('player_status_activity', ['done', 'pending']);
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
        Schema::dropIfExists('athletes');
    }
}
