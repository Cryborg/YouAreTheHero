<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_person', function (Blueprint $table) {
            $table->id();

            $table->foreignId('character_id')->constrained();
            $table->foreignId('person_id')->constrained();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();

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
        Schema::dropIfExists('character_person');
    }
}
