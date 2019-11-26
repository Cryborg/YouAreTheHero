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
            $table->unsignedBigInteger('character_id')->primary()->unique();
            $table->foreign('character_id')->references('id')->on('characters');
            $table->string('page_id', 32);
            $table->foreign('page_id')->references('id')->on('pages');

            $table->unique(['character_id', 'page_id']);

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
