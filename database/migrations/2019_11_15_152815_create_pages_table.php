<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->uuid('page_uuid');
         //   $table->foreign('story_id')->references('id')->on('stories');
            $table->boolean('is_first')->default(false);
            $table->boolean('is_last')->default(false);
            $table->string('title')->nullable();
            $table->text('description');
            $table->json('items')->nullable();
            $table->string('layout')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
