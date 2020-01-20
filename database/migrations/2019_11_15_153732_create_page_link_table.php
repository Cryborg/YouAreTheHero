<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_link', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('page_from', 36)->nullable();
            $table->foreign('page_from')->references('uuid')->on('pages');

            $table->string('page_to', 36)->nullable();
            $table->foreign('page_to')->references('uuid')->on('pages');

            $table->text('link_text');

            $table->index(['page_from']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_link');
    }
}
