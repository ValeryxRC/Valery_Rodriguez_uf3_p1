<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('films')->insert(
                [
                    "name" => $faker->sentence(3),
                    "year" => $faker->numberBetween(1900, 2022),
                    "genre" => $faker->word,
                    "country" => $faker->country,
                    "duration" => $faker->numberBetween(60, 240),
                    "img_url" => $faker->imageUrl(),
                    "created_at" => now(),
                    "updated_at" => now(),
                ]
            );
        }
    }
}
