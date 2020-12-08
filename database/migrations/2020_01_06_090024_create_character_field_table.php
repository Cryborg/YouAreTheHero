<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_field', function (Blueprint $table) {
            $table->foreignId('character_id');

            $table->foreignId('field_id');

            $table->integer('value');
            $table->integer('start_value')
                ->comment('Value at the start of the story');

            // Not sure I need this
//            $table->integer('bonus_value')
//                ->comment('Sum of the effects given by the equipped items.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_field');
    }
}
