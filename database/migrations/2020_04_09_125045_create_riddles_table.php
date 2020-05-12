<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiddlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riddles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('page_id');
            $table->foreign('page_id')->references('id')->on('pages');

            $table->string('answer', 30);
            $table->enum('type', ['integer', 'string'])->default('string');

            $table->string('target_page_text', 255)->nullable()
                ->comment('Text of the link giving the access to another page, if the riddle leads to somewhere else');
            $table->unsignedBigInteger('target_page_id')->nullable();
            $table->foreign('target_page_id')->references('id')->on('pages');

            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riddles');
    }
}
