<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            HotelProfileSeeder::class,
            RoomSeeder::class,
            SurveySectionSeeder::class,
            SurveyQuestionSeeder::class,
            UserSeeder::class,
        ]);
    }
}
