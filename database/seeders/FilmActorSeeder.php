<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $lastFilmID = DB::table("films")->max("id");
        $lastActorID = DB::table("actors")->max("id");

        // Insertar datos ficticios en la tabla intermedia film_actors
        for ($i = 0; $i < 10; $i++) {
            DB::table('films_actors')->insert(
                [
                    "film_id" => $faker->numberBetween(1, $lastFilmID),
                    "actor_id" => $faker->numberBetween(1, $lastActorID),
                    "created_at" => now(),
                    "updated_at" => now(),
                ]
            );
        }
    }
}
