<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('description')->nullable();
            $table->string('num_students')->default(0);
            $table->string('slug')->unique();    
            $table->string('class')->default('{"bg":"bg-yellow-500","color":"yellow"}');

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
        Schema::dropIfExists('schools');
    }
}
