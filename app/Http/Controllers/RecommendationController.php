<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\BscsCareer;
use App\Models\ExtraCurricularActivity;
use App\Models\Skill;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index($studentId)
    {
        $student = Student::find($studentId);
        $studentName = $student->name;
        $studentAcademicPerformance = $student->academicPerformance->academic_performance_name;
        $studentInterests = $student->interests->pluck('interest_name')->toArray();
        $studentExtraCurricularActivities = $student->extraCurricularActivities->pluck('extra_curricular_activity_name')->toArray();
        $studentPreferredCareer = $student->bscsCareer->bscs_career_name;

        $bscsCareers = BscsCareer::all();

        $bestMatchScore = 0;
        $bestMatchedCareer = null;

        // Compare student interests and extra curricular activities with each career
        foreach ($bscsCareers as $career) {
            // Initialize the score
            $careerScore = 0;
            // Compare interests
            foreach ($career->interests as $interest) {
                if ($student->interests->contains('interest_name', $interest->interest_name)) {
                    $careerScore++;
                }
            }
            // Compare extra curricular activities
            foreach ($career->extraCurricularActivities as $activity) {
                if ($student->extraCurricularActivities->contains('extra_curricular_activity_name', $activity->extra_curricular_activity_name)) {
                    $careerScore++;
                }
            }
            // Update the bscs_career_student pivot table with the score
            if ($careerScore > 0) {
                $career->studentWithBscsScores()->syncWithoutDetaching([$student->id => ['score' => $careerScore]]);
            }
            // Update the best match if the current career has a higher score
            if ($careerScore > $bestMatchScore) {
                $bestMatchScore = $careerScore;
                $bestMatchedCareer = $career;
            }
        }
        // Check academic performance
        if (!in_array($studentAcademicPerformance, ['Outstanding', 'Excellent', 'Very Good'])) {
            // Find the career with difficulty 'medium' or 'easy'
            $studentCareerWithScores = BscsCareer::whereHas('studentWithBscsScores', function ($query) use ($studentId) {
                $query->where('student_id', $studentId)
                    ->whereNotNull('score');
            })
                ->whereIn('difficulty', ['medium', 'easy'])
                ->with('studentWithBscsScores')
                ->get();

            $sortedCareers = $studentCareerWithScores->sortByDesc('studentWithBscsScores.score');
            $firstCareer = $sortedCareers->first();

            if ($firstCareer) {
                $bestMatchedCareer = $firstCareer;
            } else {
                $bestMatchedCareer = null;
            }
        }

        $activitySkills = ExtraCurricularActivity::whereHas('skills')->get();

        $programmingAndDevelopmentActivities = $activitySkills->filter(function ($activity) {
            return $activity->skills->contains('skill_name', 'Programming and Development');
        });
        $dataScienceAndAnalyticsActivities = $activitySkills->filter(function ($activity) {
            return $activity->skills->contains('skill_name', 'Data Science and Analytics');
        });
        $networkAndCybersecurityActivities = $activitySkills->filter(function ($activity) {
            return $activity->skills->contains('skill_name', 'Network and Cybersecurity');
        });
        $designAndUserExperienceActivities = $activitySkills->filter(function ($activity) {
            return $activity->skills->contains('skill_name', 'Design and User Experience');
        });
        $devOpsandAutomationActivities = $activitySkills->filter(function ($activity) {
            return $activity->skills->contains('skill_name', 'DevOps and Automation');
        });

        $programmingAndDevelopmentCount = 0;
        $dataScienceAndAnalyticsCount = 0;
        $networkAndCybersecurityCount = 0;
        $designAndUserExperienceCount = 0;
        $devOpsandAutomationCount = 0;

        // Count the number of activities for each skill
        foreach ($studentExtraCurricularActivities as $activity) {
            if ($programmingAndDevelopmentActivities->contains('extra_curricular_activity_name', $activity)) {
                $programmingAndDevelopmentCount++;
            }
            if ($dataScienceAndAnalyticsActivities->contains('extra_curricular_activity_name', $activity)) {
                $dataScienceAndAnalyticsCount++;
            }
            if ($networkAndCybersecurityActivities->contains('extra_curricular_activity_name', $activity)) {
                $networkAndCybersecurityCount++;
            }
            if ($designAndUserExperienceActivities->contains('extra_curricular_activity_name', $activity)) {
                $designAndUserExperienceCount++;
            }
            if ($devOpsandAutomationActivities->contains('extra_curricular_activity_name', $activity)) {
                $devOpsandAutomationCount++;
            }
        }

        $pointsPerProgrammingAndDevelopmentActivity = 10 / $programmingAndDevelopmentActivities->count();
        $pointsPerDataScienceAndAnalyticsActivity = 10 / $dataScienceAndAnalyticsActivities->count();
        $pointsPerNetworkAndCybersecurityActivity = 10 / $networkAndCybersecurityActivities->count();
        $pointsPerDesignAndUserExperienceActivity = 10 / $designAndUserExperienceActivities->count();
        $pointsPerDevOpsandAutomationActivity = 10 / $devOpsandAutomationActivities->count();

        $programmingAndDevelopmentPoints = round($programmingAndDevelopmentCount * $pointsPerProgrammingAndDevelopmentActivity);
        $dataScienceAndAnalyticsPoints = round($dataScienceAndAnalyticsCount * $pointsPerDataScienceAndAnalyticsActivity);
        $networkAndCybersecurityPoints = round($networkAndCybersecurityCount * $pointsPerNetworkAndCybersecurityActivity);
        $designAndUserExperiencePoints = round($designAndUserExperienceCount * $pointsPerDesignAndUserExperienceActivity);
        $devOpsandAutomationPoints = round($devOpsandAutomationCount * $pointsPerDevOpsandAutomationActivity);

        $skillPointsData = [
            $programmingAndDevelopmentPoints,
            $dataScienceAndAnalyticsPoints,
            $networkAndCybersecurityPoints,
            $designAndUserExperiencePoints,
            $devOpsandAutomationPoints,
        ];

        $datasetLabel1 = 'Extra Curricular Activities of ' . $studentName;
        $datasetLabel2 = 'Interest of ' . $studentName;
        $skillNames = Skill::all()->pluck('skill_name')->toArray();

        // dd($skillNames, $studentExtraCurricularActivities, $skillPointsData, $programmingAndDevelopmentActivities);

        return view('recommendation', compact(
            'studentName',
            'datasetLabel1',
            'datasetLabel2',
            'studentAcademicPerformance',
            'studentPreferredCareer',
            'studentExtraCurricularActivities',
            'studentInterests',
            'bestMatchedCareer',
            'skillNames',
            'skillPointsData'
        ));
    }
}
