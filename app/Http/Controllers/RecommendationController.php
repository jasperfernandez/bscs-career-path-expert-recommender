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

        foreach ($bscsCareers as $career) {
            $careerScore = 0;

            // Check for matching interests
            foreach ($career->interests as $interest) {
                if ($student->interests->contains('interest_name', $interest->interest_name)) {
                    $careerScore++;
                }
            }

            // Check for matching extracurricular activities
            foreach ($career->extraCurricularActivities as $activity) {
                if ($student->extraCurricularActivities->contains('extra_curricular_activity_name', $activity->extra_curricular_activity_name)) {
                    $careerScore++;
                }
            }

            // Increment the score in the pivot table
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
            // Find the career with difficulty 'medium' or 'easy' that has the highest score
            $studentCareerWithScores = BscsCareer::whereHas('studentWithBscsScores', function ($query) use ($studentId) {
                $query->where('student_id', $studentId)
                    ->whereNotNull('score');
            })
                ->whereIn('difficulty', ['medium', 'easy'])
                ->with('studentWithBscsScores') // Eager load the relationship
                ->get();

            $sortedCareers = $studentCareerWithScores->sortByDesc('studentWithBscsScores.score');
            $firstCareer = $sortedCareers->first();

            if ($firstCareer) {
                $bestMatchedCareer = $firstCareer;
            } else {
                $bestMatchedCareer = null;
            }
        }

        $skillNames = Skill::all()->pluck('skill_name')->toArray();
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

        $programmingAndDevelopmentPoints = round($programmingAndDevelopmentCount * 3.33);
        $dataScienceAndAnalyticsPoints = round($dataScienceAndAnalyticsCount * 1.25);
        $networkAndCybersecurityPoints = round($networkAndCybersecurityCount * 1.42);
        $designAndUserExperiencePoints = round($designAndUserExperienceCount * 2);
        $devOpsandAutomationPoints = round($devOpsandAutomationCount * 3.33);

        $skillPointsData = [
            $programmingAndDevelopmentPoints,
            $dataScienceAndAnalyticsPoints,
            $networkAndCybersecurityPoints,
            $designAndUserExperiencePoints,
            $devOpsandAutomationPoints,
        ];

        return view('recommendation', compact(
            'studentName',
            'studentAcademicPerformance',
            'studentPreferredCareer',
            'bestMatchedCareer',
            'skillNames',
            'skillPointsData'
        ));
    }
}
