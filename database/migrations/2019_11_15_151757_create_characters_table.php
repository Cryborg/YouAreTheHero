<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');

            // User owning the character
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // Story in which the character plays
            $table->unsignedInteger('story_id');
            $table->foreign('story_id')->references('id')->on('stories');

            // Last page visited in the sotry
            $table->uuid('page_uuid');
            $table->foreign('page_uuid')->references('uuid')->on('pages');

            // Amount of money owned by the character
            $table->unsignedInteger('money')->default(10);

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
        Schema::dropIfExists('characters');
    }
}
