<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExtraCurricularActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExtracurricularActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Open-source Contributions']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Coding Competitions']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Hackathons']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Data Science Projects']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Statistics or Machine Learning Clubs']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Interships in Data Centric Roles']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Networking Workshops']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Network Administration Projects']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Cybersecurity Clubs']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Internship with IT Departments']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Web Development Projects']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Design/UI/UX Workshops']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Web Development Competitions']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Database Management Projects']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'SQL Query Competitions']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Cybersecurity Certifications']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Capture The Flag (CTF) Competitions']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Mobile App Development Projects']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'DevOps Projects and Automation Scripts']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Game Development Projects']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Cybersecurity Conferences/Workshops']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => '3D Modeling Workshops']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'AI/ML Research Projects']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Continuous Learning and Certifications']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Participation in DevOps Meetups']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Internships with a focus on DevOps practices']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Internships with AI-focused companies']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'AI/ML workshops']);
        ExtraCurricularActivity::create(['extra_curricular_activity_name' => 'Participation in game development competitions']);
    }
}
