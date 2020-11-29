<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoryOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_options', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('story_id')->constrained();

            $table->boolean('has_character')->default(false)
                ->comment('Do we have to create a character for this story?');
            $table->enum('character_genre', ['male', 'female', 'both'])->nullable()->default(null);
            $table->boolean('has_stats')->default(false)
                ->comment('Do we show the stats creation page?');
            $table->enum('stat_attribution', ['player', 'dice'])->default('player')
                ->comment('"player" means the player gives :points_to_share: points manually to his character. "dice" means it is done by throwing dice.');
            $table->integer('points_to_share')->default(10)
                ->comment('Points to share between character stats');
            $table->integer('inventory_slots')->default(-1)
                ->comment('How many (virtual) slots there are in the inventory.');
            $table->integer('currency_amount')->default(10)
                ->comment('Default amount of the currency when a new character is created.');


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
        Schema::dropIfExists('story_options');
    }
}
