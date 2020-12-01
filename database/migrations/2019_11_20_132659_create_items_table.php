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

            $table->foreignId('story_id');

            $table->string('category', 20)->nullable();
            $table->string('name', 30);
            $table->unsignedInteger('default_price')->default(0);
            $table->boolean('single_use')->default(false);
            $table->boolean('is_unique')->default(false);
            $table->boolean('is_throwable')->default(true);

            $table->foreignId('equipment_id')->nullable();

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
