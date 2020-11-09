<?php

use App\Classes\Constants;
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
            $table->string('password', 100)->nullable();
            $table->string('locale', 5)->default('fr_FR');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', [Constants::ROLE_ADMIN, Constants::ROLE_MODERATOR, Constants::ROLE_MEMBER, Constants::ROLE_TEMPORARY, Constants::ROLE_DEVELOPER])->default(Constants::ROLE_MEMBER);
            $table->boolean('optin_system')->default(false);

            // Google Auth
            $table->string('google_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_original')->nullable();

            $table->timestamp('valid_from')->nullable()->default(null);
            $table->rememberToken();
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
