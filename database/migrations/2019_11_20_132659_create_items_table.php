<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('story_id');
            $table->foreign('story_id')->references('id')->on('stories');

            $table->string('category', 20)->nullable();
            $table->string('name', 30);
            $table->unsignedInteger('default_price')->default(0);
            $table->boolean('is_unique')->default(false);

            $table->float('size')->default(1)
                  ->comment('How much room it takes in the inventory.');

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
        Schema::dropIfExists('items');
    }
}
