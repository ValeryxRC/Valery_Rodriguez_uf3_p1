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
        Schema::create('films_actors', function (Blueprint $table){
            $table->unsignedBigInteger('film_id');
            $table->unsignedBigInteger('actor_id');
            $table->timestamps();
            $table->primary(['film_id', 'actor_id']);
            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('film-actor', function (Blueprint $table){
            Schema::drop('film-actor');
        });
    }
};
