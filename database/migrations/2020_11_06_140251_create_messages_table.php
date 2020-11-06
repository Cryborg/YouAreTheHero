<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('from')->default(\Illuminate\Support\Facades\Config::get('app.mails.bot'));
            $table->foreign('from')->references('id')->on('users');

            $table->unsignedBigInteger('to');
            $table->foreign('to')->references('id')->on('users');

            $table->string('subject');
            $table->string('body');

            $table->timestamp('viewed_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
