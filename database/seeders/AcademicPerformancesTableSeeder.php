<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicPerformance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AcademicPerformancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $acadPerf = [
            'Outstanding',
            'Excellent',
            'Very Good',
            'Good',
            'Fair',
            'Poor',
            'Failed',
        ];

        foreach ($acadPerf as $perf) {
            AcademicPerformance::create(['academic_performance_name' => $perf]);
        }
    }
}
