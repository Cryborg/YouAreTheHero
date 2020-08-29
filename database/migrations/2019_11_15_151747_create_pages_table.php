<?php

use App\Classes\Constants;
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
            $table->bigIncrements('id');

            $table->unsignedBigInteger('story_id');
            $table->foreign('story_id')
                  ->references('id')
                  ->on('stories');

            $table->boolean('is_first')
                  ->default(false);
            $table->boolean('is_last')
                  ->default(false);
            $table->string('title')
                  ->nullable();
            $table->text('content');
            $table->string('layout')
                  ->default('play1')
                  ->nullable();
            $table->boolean('is_checkpoint')
                  ->default(false);
            $table->boolean('is_shop')
                  ->default(false)
                  ->comment('Whether the player can sell objects in this page.');
            $table->string('ending_type')
                  ->nullable()
                  ->default(Constants::ENDING_TYPE_GOOD)
                  ->comment('If is_last, type of the ending, wether it is good, bad, a death, etc');

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
        Schema::dropIfExists('pages');
    }
}
