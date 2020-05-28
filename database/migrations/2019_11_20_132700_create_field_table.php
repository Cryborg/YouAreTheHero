<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('story_id');
            $table->foreign('story_id')->references('id')->on('stories');

            $table->string('name', 15);
            $table->string('short_name', 5);
            $table->integer('min_value');
            $table->integer('max_value');
            $table->integer('start_value');
            $table->integer('order')->default(1);

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
        Schema::dropIfExists('fields');
    }
}
