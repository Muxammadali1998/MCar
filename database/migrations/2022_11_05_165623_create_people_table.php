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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('path_id');
            $table->unsignedBigInteger('client_id');
            $table->foreign('path_id')
            ->references('id')->on('paths')->onDelete('cascade');
            $table->foreign('client_id')
            ->references('id')->on('clients')->onDelete('cascade');
            $table->integer('area');
            $table->string('status')->default('0');
            $table->string('name')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
        Schema::dropIfExists('people');
    }
};
