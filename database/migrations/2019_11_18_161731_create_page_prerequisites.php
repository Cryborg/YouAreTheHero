<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagePrerequisites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_prerequisites', function (Blueprint $table) {
            $table->integerIncrements('page_id');
            $table->integer('prerequisites_id');

//            $table->foreign('page_id')->references('id')->on('pages');
//            $table->foreign('prerequisites_id')->references('id')->on('prerequisites_types');
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
        Schema::dropIfExists('page_prerequisites');
    }
}
