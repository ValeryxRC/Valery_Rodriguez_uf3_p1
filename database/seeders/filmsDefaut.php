<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Seeder\Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class filmsDefaut extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creamos un objeto tipo Faker
        $faker    = Faker::create();

        $films = Storage::json('/public/films.json');
        foreach ($films as $value) {
            DB::table('films')->insert($value);
        }
        $this->command->info("tabla de pelis rellenada");
    }
}
