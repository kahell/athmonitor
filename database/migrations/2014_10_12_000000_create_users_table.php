<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('fullname')->nullable();
          $table->enum('gender', ['man', 'woman']);
          $table->string('avatar')->nullable();
          $table->string('address')->nullable();
          $table->string('bod')->nullable();
          $table->string('phone_number')->unique()->nullable();
          $table->string('username')->unique()->index();
          $table->string('email')->unique()->index();
          $table->string('password');
          $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
