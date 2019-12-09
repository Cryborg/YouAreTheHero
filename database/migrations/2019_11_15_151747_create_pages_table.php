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
            $table->uuid('id')->primary();
            $table->unsignedInteger('story_id');
            $table->unsignedInteger('number');
            $table->foreign('story_id')->references('id')->on('stories');
            $table->boolean('is_first')->default(false);
            $table->boolean('is_last')->default(false);
            $table->string('title')->nullable();
            $table->text('content');
            $table->softDeletes();
            $table->json('items')->nullable();
            $table->json('prerequisites')->nullable();
            $table->string('layout')->nullable();
            $table->boolean('is_checkpoint')->default(false);
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
