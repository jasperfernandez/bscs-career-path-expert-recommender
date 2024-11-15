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

        // Define the mapping of careers to interests and activities
        $careerMappings = [
            'Software Developer/Engineer' => [
                'interests' => [1, 2, 3, 10, 11],
                'activities' => [1, 2, 3, 11, 13, 18, 20, 24]
            ],
            'Data Scientist/Analyst' => [
                'interests' => [4, 5, 6, 14, 15, 28, 29],
                'activities' => [4, 5, 6, 14, 15, 23, 24, 27, 28]
            ],
            'Network Administrator' => [
                'interests' => [7, 8, 9, 16, 17, 18],
                'activities' => [7, 8, 9, 10, 16, 17, 21]
            ],
            'Web Developer' => [
                'interests' => [10, 11, 12, 13],
                'activities' => [11, 12, 13, 18, 20]
            ],
            'Database Administrator' => [
                'interests' => [13, 14, 15],
                'activities' => [14, 15, 24]
            ],
            'Cybersecurity Analyst' => [
                'interests' => [8, 16, 17, 18],
                'activities' => [9, 10, 16, 17, 21]
            ],
            'Mobile App Developer' => [
                'interests' => [19],
                'activities' => [18]
            ],
            'DevOps Engineer' => [
                'interests' => [20, 21, 22],
                'activities' => [19, 24, 25, 26]
            ],
            'Game Developer' => [
                'interests' => [23, 24, 25],
                'activities' => [20, 30]
            ],
            'Artificial Intelligence Engineer' => [
                'interests' => [26, 27, 28, 29],
                'activities' => [23, 24, 27, 28]
            ],
        ];

        // Attach interests and activities to each career
        foreach ($careerMappings as $careerName => $mappings) {
            $career = BscsCareer::where('bscs_career_name', $careerName)->first();
            if ($career) {
                $career->interests()->sync($mappings['interests']);
                $career->extraCurricularActivities()->sync($mappings['activities']);
            }
        }
    }
}
