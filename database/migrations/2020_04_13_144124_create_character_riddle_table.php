<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterRiddleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_riddle', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('character_id');
            $table->foreign('character_id')->references('id')->on('characters');

            $table->unsignedBigInteger('riddle_id');
            $table->foreign('riddle_id')->references('id')->on('riddles');

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
        Schema::dropIfExists('character_riddle');
    }
}
