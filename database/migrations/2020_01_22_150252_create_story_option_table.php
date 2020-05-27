<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoryOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_options', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('story_id');
            $table->foreign('story_id')->references('id')->on('stories');

            $table->boolean('has_character')->default(false)
                ->comment('Do we have to create a character for this story?');
            $table->boolean('has_stats')->default(false)
                ->comment('Do we show the stats creation page?');
            $table->enum('stat_attribution', ['player', 'dice'])->default('player')
                ->comment('"player" means the player gives :points_to_share: points manually to his character. "dice" means it is done by throwing dice.');
            $table->integer('points_to_share')->default(10)
                ->comment('Points to share amongst character stats');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('story_options');
    }
}
