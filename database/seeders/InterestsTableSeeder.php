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
        Interest::create(['interest_name' => 'Coding']);
        Interest::create(['interest_name' => 'Problem-solving']);
        Interest::create(['interest_name' => 'Algorithms']);
        Interest::create(['interest_name' => 'Data Analysis']);
        Interest::create(['interest_name' => 'Statistics']);
        Interest::create(['interest_name' => 'Machine Learning']);
        Interest::create(['interest_name' => 'Networking']);
        Interest::create(['interest_name' => 'Security']);
        Interest::create(['interest_name' => 'Troubleshooting']);
        Interest::create(['interest_name' => 'Front-end Development']);
        Interest::create(['interest_name' => 'Back-end Development']);
        Interest::create(['interest_name' => 'UX/UI Design']);
        Interest::create(['interest_name' => 'Database Design']);
        Interest::create(['interest_name' => 'SQL']);
        Interest::create(['interest_name' => 'Data Management']);
        Interest::create(['interest_name' => 'Cybersecurity']);
        Interest::create(['interest_name' => 'Ethical Hacking']);
        Interest::create(['interest_name' => 'Risk Analysis']);
        Interest::create(['interest_name' => 'Mobile App Development']);
        Interest::create(['interest_name' => 'User Experience (UX)']);
        Interest::create(['interest_name' => 'Automation']);
        Interest::create(['interest_name' => 'Continous Integration']);
        Interest::create(['interest_name' => 'Deployment']);
        Interest::create(['interest_name' => 'Game Design']);
        Interest::create(['interest_name' => '3D Modeling']);
        Interest::create(['interest_name' => 'Virtual Reality']);
        Interest::create(['interest_name' => 'Deep Learning']);
        Interest::create(['interest_name' => 'Artificial Intelligence']);
        Interest::create(['interest_name' => 'AI Research']);
    }
}
