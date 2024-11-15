<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\InterestsTableSeeder;
use Database\Seeders\BscsCareersTableSeeder;
use Database\Seeders\AcademicPerformancesTableSeeder;
use Database\Seeders\ExtracurricularActivitiesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BscsCareersTableSeeder::class,
            ExtracurricularActivitiesTableSeeder::class,
            InterestsTableSeeder::class,
            AcademicPerformancesTableSeeder::class,
            BscsCareerExtracurricularActivityInterestTableSeeder::class,
        ]);
    }
}
