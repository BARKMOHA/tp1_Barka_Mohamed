<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipment_sport', function (Blueprint $table) {

            $table->integer('equipment_id');
            $table->integer('sport_id');
            /**
                *prompt: comment definir un cle primere dans un table many to many dans laravel
            */
            $table->primary(['equipment_id', 'sport_id']);
            $table->foreign('equipment_id')->references('id')->on('equipment');
            $table->foreign('sport_id')->references('id')->on('sports');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_sport');
    }
};
