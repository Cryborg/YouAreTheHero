<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choices', static function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('page_from')->nullable();
            $table->foreign('page_from')->references('id')->on('pages');

            $table->unsignedBigInteger('page_to')->nullable();
            $table->foreign('page_to')->references('id')->on('pages');

            $table->text('link_text');

            $table->boolean('hidden')->default(0);

            $table->index(['page_from']);

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
        Schema::dropIfExists('choices');
    }
}
