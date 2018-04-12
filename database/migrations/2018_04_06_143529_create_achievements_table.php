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
          $table->bigIncrements('achievement_id');
          $table->string('achieve_key')->nullable();
          $table->string('name');
          $table->text('description')->nullable();
          $table->string('images')->nullable();
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
