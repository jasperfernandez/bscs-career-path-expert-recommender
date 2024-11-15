<?php

namespace Database\Seeders;

use App\Models\Skill;
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
        // Create skills
        $skills = [
            'Programming and Development' => Skill::create(['skill_name' => 'Programming and Development']),
            'Data Science and Analytics' => Skill::create(['skill_name' => 'Data Science and Analytics']),
            'Network and Cybersecurity' => Skill::create(['skill_name' => 'Network and Cybersecurity']),
            'Design and User Experience' => Skill::create(['skill_name' => 'Design and User Experience']),
            'DevOps and Automation' => Skill::create(['skill_name' => 'DevOps and Automation']),
        ];

        // Create extracurricular activities and sync related skills
        $activities = [
            'Open-source Contributions' => ['Programming and Development'],
            'Coding Competitions' => ['Programming and Development'],
            'Hackathons' => ['Programming and Development', 'Data Science and Analytics'],
            'Data Science Projects' => ['Data Science and Analytics'],
            'Statistics or Machine Learning Clubs' => ['Data Science and Analytics'],
            'Interships in Data Centric Roles' => ['Data Science and Analytics'],
            'Networking Workshops' => ['Network and Cybersecurity'],
            'Network Administration Projects' => ['Network and Cybersecurity'],
            'Cybersecurity Clubs' => ['Network and Cybersecurity'],
            'Internship with IT Departments' => ['Network and Cybersecurity'],
            'Web Development Projects' => ['Programming and Development', 'Design and User Experience'],
            'Design/UI/UX Workshops' => ['Design and User Experience'],
            'Web Development Competitions' => ['Programming and Development', 'Design and User Experience'],
            'Database Management Projects' => ['Data Science and Analytics'],
            'SQL Query Competitions' => ['Data Science and Analytics'],
            'Cybersecurity Certifications' => ['Network and Cybersecurity'],
            'Capture The Flag (CTF) Competitions' => ['Network and Cybersecurity'],
            'Mobile App Development Projects' => ['Programming and Development'],
            'DevOps Projects and Automation Scripts' => ['DevOps and Automation'],
            'Game Development Projects' => ['Programming and Development'],
            'Cybersecurity Conferences/Workshops' => ['Network and Cybersecurity'],
            '3D Modeling Workshops' => ['Design and User Experience'],
            'AI/ML Research Projects' => ['Data Science and Analytics'],
            'Continuous Learning and Certifications' => ['Programming and Development', 'Data Science and Analytics', 'Network and Cybersecurity', 'Design and User Experience', 'DevOps and Automation'],
            'Participation in DevOps Meetups' => ['DevOps and Automation'],
            'Internships with a focus on DevOps practices' => ['DevOps and Automation'],
            'Internships with AI-focused companies' => ['Data Science and Analytics'],
            'AI/ML workshops' => ['Data Science and Analytics'],
            'Participation in game development competitions' => ['Programming and Development'],
        ];

        foreach ($activities as $activityName => $skillNames) {
            $activity = ExtraCurricularActivity::create(['extra_curricular_activity_name' => $activityName]);
            $skillIds = array_map(fn($skillName) => $skills[$skillName]->id, $skillNames);
            $activity->skills()->sync($skillIds);
        }
    }
}
