<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCensusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('censuses', function (Blueprint $table) {
            $table->id();

            $table->string('document', 12)->uniqid();
            $table->string('code', 4);
            $table->string('grade', 32)->nullable();
            $table->string('group', 32)->nullable();
            $table->string('name');
            $table->string('last_name');
            $table->string('phone', 16)->nullable();
            $table->string('photo')->nullable();
            $table->boolean('condition')->default(false);

            $table->foreignId('users_id')->constrained(); //->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('censuses');
    }
}
