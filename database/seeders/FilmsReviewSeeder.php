<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FilmsReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $lastFilmID = DB::table("films")->max("id");
        for ($i=0; $i < 10; $i++) { 
            DB::table('films_review')->insert(
                [
                    "film_id" => $faker->numberBetween(1, $lastFilmID),
                    "calification" => $faker->numberBetween(1,10),
                ]
                );
        }
    }
}
