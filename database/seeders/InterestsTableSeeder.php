<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InterestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interests = [
            ['interest_name' => 'Coding', 'skill_id' => 1],
            ['interest_name' => 'Problem-solving', 'skill_id' => 1],
            ['interest_name' => 'Algorithms', 'skill_id' => 1],
            ['interest_name' => 'Data Analysis', 'skill_id' => 2],
            ['interest_name' => 'Statistics', 'skill_id' => 2],
            ['interest_name' => 'Machine Learning', 'skill_id' => 2],
            ['interest_name' => 'Networking', 'skill_id' => 3],
            ['interest_name' => 'Security', 'skill_id' => 3],
            ['interest_name' => 'Troubleshooting', 'skill_id' => 3],
            ['interest_name' => 'Front-end Development', 'skill_id' => 1],
            ['interest_name' => 'Back-end Development', 'skill_id' => 1],
            ['interest_name' => 'UX/UI Design', 'skill_id' => 4],
            ['interest_name' => 'Database Design', 'skill_id' => 2],
            ['interest_name' => 'SQL', 'skill_id' => 2],
            ['interest_name' => 'Data Management', 'skill_id' => 2],
            ['interest_name' => 'Cybersecurity', 'skill_id' => 3],
            ['interest_name' => 'Ethical Hacking', 'skill_id' => 3],
            ['interest_name' => 'Risk Analysis', 'skill_id' => 3],
            ['interest_name' => 'Mobile App Development', 'skill_id' => 1],
            ['interest_name' => 'User Experience (UX)', 'skill_id' => 4],
            ['interest_name' => 'Automation', 'skill_id' => 5],
            ['interest_name' => 'Continous Integration', 'skill_id' => 5],
            ['interest_name' => 'Deployment', 'skill_id' => 5],
            ['interest_name' => 'Game Design', 'skill_id' => 1],
            ['interest_name' => '3D Modeling', 'skill_id' => 4],
            ['interest_name' => 'Virtual Reality', 'skill_id' => 4],
            ['interest_name' => 'Deep Learning', 'skill_id' => 2],
            ['interest_name' => 'Artificial Intelligence', 'skill_id' => 2],
            ['interest_name' => 'AI Research', 'skill_id' => 2],
        ];

        foreach ($interests as $interestData) {
            $interest = Interest::create(['interest_name' => $interestData['interest_name']]);
            $interest->skills()->attach($interestData['skill_id']);
        }
    }
}
