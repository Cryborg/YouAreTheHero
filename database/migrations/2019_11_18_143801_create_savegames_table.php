<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavegamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savegames', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('story_id', 32);
            $table->foreign('story_id')->references('id')->on('stories');
            $table->string('paragraph_id', 32);
            $table->foreign('paragraph_id')->references('id')->on('paragraphs');

            $table->primary(['user_id', 'story_id']);
            $table->unique(['user_id', 'story_id']);

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
        Schema::dropIfExists('savegames');
    }
}
