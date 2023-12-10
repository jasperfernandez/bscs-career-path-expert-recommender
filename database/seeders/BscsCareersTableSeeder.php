<?php

namespace Database\Seeders;

use App\Models\BscsCareer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BscsCareersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BscsCareer::create(['bscs_career_name' => 'Software Developer/Engineer', 'difficulty' => 'medium']);
        BscsCareer::create(['bscs_career_name' => 'Data Scientist/Analyst', 'difficulty' => 'hard']);
        BscsCareer::create(['bscs_career_name' => 'Network Administrator', 'difficulty' => 'medium']);
        BscsCareer::create(['bscs_career_name' => 'Web Developer', 'difficulty' => 'medium']);
        BscsCareer::create(['bscs_career_name' => 'Database Administrator', 'difficulty' => 'medium']);
        BscsCareer::create(['bscs_career_name' => 'Cybersecurity Analyst', 'difficulty' => 'hard']);
        BscsCareer::create(['bscs_career_name' => 'Mobile App Developer', 'difficulty' => 'medium']);
        BscsCareer::create(['bscs_career_name' => 'DevOps Engineer', 'difficulty' => 'hard']);
        BscsCareer::create(['bscs_career_name' => 'Game Developer', 'difficulty' => 'medium']);
        BscsCareer::create(['bscs_career_name' => 'Artificial Intelligence Engineer', 'difficulty' => 'hard']);
    }
}
