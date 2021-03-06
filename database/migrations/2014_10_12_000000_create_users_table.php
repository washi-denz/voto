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
            $table->id();

            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('api_token')->nullable();
            $table->string('avatar')->default('default.png');

            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();

            $table->foreignId('school_id')->constrained();

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
        Schema::dropIfExists('users');
    }
}
