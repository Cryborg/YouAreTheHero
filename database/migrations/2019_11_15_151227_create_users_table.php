<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();

            $table->string('first_name', 30)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->string('username', 30)->unique();
            $table->string('email', 50)->unique();
            $table->string('password', 100);
            $table->string('locale', 5)->default('fr_FR');
            $table->dateTime('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->enum('role', ['member', 'admin'])->default('member');

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
        Schema::dropIfExists('users');
    }
}
