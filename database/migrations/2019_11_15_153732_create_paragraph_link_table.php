<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParagraphLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paragraph_link', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('paragraph_from', 255);
            $table->foreign('paragraph_from')->references('id')->on('paragraphs');
            $table->string('paragraph_to', 32);
            $table->foreign('paragraph_to')->references('id')->on('paragraphs');
            $table->string('link_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paragraph_link');
    }
}
