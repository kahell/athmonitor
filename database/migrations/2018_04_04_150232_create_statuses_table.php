<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
          $table->bigIncrements('status_id');
          $table->unsignedBigInteger('user_id')->index();
          $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
          $table->enum('account_status_id', ['active', 'inactive','banned','blocked']);
          $table->integer('failedLoginAttempt')->default(0)->nullable();
          $table->dateTime('blocked_time')->nullable();
          $table->dateTime('last_login')->nullable();
          $table->boolean('isBlocked')->default(false)->index();
          $table->string('accVerificationCode')->nullable();
          $table->boolean('isResetPass')->default(false)->index();
          $table->string('resetPassVerificationCode')->nullable();
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
        Schema::dropIfExists('statuses');
    }
}
