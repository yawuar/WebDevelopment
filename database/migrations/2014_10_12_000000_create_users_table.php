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
            $table->increments('user_id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('address')->nullable();
            $table->integer('number')->default(0);
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('email')->unique();
            $table->string('ip_address')->nullable();
            $table->string('password');
            $table->string('photo_path')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->boolean('disqualified')->default(0);
            $table->integer('contest_id');
            $table->rememberToken();
            $table->softDeletes();
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
