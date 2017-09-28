<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_photos', function (Blueprint $table) {
            $table->increments('contest_photos_id');
            $table->string('photo_path')->nullable();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->integer('user_id');
            $table->integer('vote_id');
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
        Schema::dropIfExists('contest_photos');
    }
}
