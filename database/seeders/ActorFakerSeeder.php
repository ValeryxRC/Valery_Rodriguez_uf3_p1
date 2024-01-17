<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $lastIntID = DB::table("actors")->max("id");

        for($i=$lastIntID; $i<$lastIntID+10; $i++){
            DB::table('actors')->insert(
                [
                    "name" => $faker->firstName,
                    "surname" => $faker->lastName,
                    "birthdate" => $faker->date,
                    "country" => $faker->country,
                    "img_url" => $faker->imageUrl,
                    "created_at" => now(),
                    "updated_at" => now(),

                ]
            );
        }
        
    }
}
