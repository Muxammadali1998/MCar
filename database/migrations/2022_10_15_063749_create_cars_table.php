<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->unique();
            $table->string('number')->unique();
            $table->string('model');
            $table->string('marka');
            $table->string('type');
            $table->string('coller');
            $table->string('year');
            $table->string('smoking')->nullable();
            $table->string('animals')->nullable();
            $table->string('music')->nullable();
            $table->string('speaking')->nullable();
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
        Schema::dropIfExists('cars');
    }
};
