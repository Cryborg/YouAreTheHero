<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_stats', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('character_id');
            $table->foreign('character_id')->references('id')->on('characters');

            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id')->references('id')->on('fields');

            $table->integer('value');

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
        Schema::dropIfExists('character_stats');
    }
}
