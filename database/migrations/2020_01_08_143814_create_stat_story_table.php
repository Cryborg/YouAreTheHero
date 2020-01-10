<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatStoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stat_story', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('story_id');
            $table->foreign('story_id')->references('id')->on('stories');
            $table->string('stat_full_name', 50);
            $table->string('stat_short_name', 3);
            $table->integer('stat_min_value');
            $table->integer('stat_max_value');
            $table->integer('stat_start_value');
            $table->integer('stat_order')->default(1);
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
        Schema::dropIfExists('stat_story');
    }
}
