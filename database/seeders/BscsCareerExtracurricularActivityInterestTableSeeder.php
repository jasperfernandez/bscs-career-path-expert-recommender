<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\BscsCareer;
use Illuminate\Database\Seeder;
use App\Models\ExtraCurricularActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BscsCareerExtracurricularActivityInterestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bscsCareers = BscsCareer::all();
        $interests = Interest::all();
        $extraCurricularActivities = ExtraCurricularActivity::all();
    }
}
