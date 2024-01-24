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
        Schema::create('films_review', function (Blueprint $table){
            $table->unsignedBigInteger('film_id');
            $table->integer('calification');
            $table->primary('film_id');
            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films_review', function (Blueprint $table){
            Schema::drop('films_review');
        });
    }
};
