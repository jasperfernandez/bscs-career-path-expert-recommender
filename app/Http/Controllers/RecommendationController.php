<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Student;
use App\Models\Interest;
use App\Models\BscsCareer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ExtraCurricularActivity;

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
        }

        // Check academic performance
        if (!in_array($studentAcademicPerformance, ['Outstanding', 'Excellent', 'Very Good'])) {
            // Find the careers with difficulty 'medium' or 'easy' for a specific student
            $matchedCareers = DB::table('bscs_careers')
                ->whereIn('difficulty', ['medium', 'easy'])
                ->whereExists(function ($query) use ($studentId) {
                    $query->select(DB::raw(1))
                        ->from('students')
                        ->join('bscs_career_student', 'students.id', '=', 'bscs_career_student.student_id')
                        ->whereColumn('bscs_careers.id', 'bscs_career_student.bscs_career_id')
                        ->where('student_id', $studentId)
                        ->whereNotNull('score');
                })
                ->leftJoin('bscs_career_student', function ($join) use ($studentId) {
                    $join->on('bscs_careers.id', '=', 'bscs_career_student.bscs_career_id')
                        ->where('bscs_career_student.student_id', $studentId);
                })
                ->select('bscs_careers.*', 'bscs_career_student.score')
                ->orderByDesc('bscs_career_student.score') // Order by score in descending order
                ->get();

            // Get the highest score
            $highestScore = $matchedCareers->first()->score;

            // Filter careers with the highest score
            $careersWithHighestScore = $matchedCareers->filter(function ($career) use ($highestScore) {
                return $career->score == $highestScore;
            });
        } else {
            $matchedCareers = DB::table('bscs_careers')
                ->whereExists(function ($query) use ($studentId) {
                    $query->select(DB::raw(1))
                        ->from('students')
                        ->join('bscs_career_student', 'students.id', '=', 'bscs_career_student.student_id')
                        ->whereColumn('bscs_careers.id', 'bscs_career_student.bscs_career_id')
                        ->where('student_id', $studentId)
                        ->whereNotNull('score');
                })
                ->leftJoin('bscs_career_student', function ($join) use ($studentId) {
                    $join->on('bscs_careers.id', '=', 'bscs_career_student.bscs_career_id')
                        ->where('bscs_career_student.student_id', $studentId);
                })
                ->select('bscs_careers.*', 'bscs_career_student.score')
                ->orderByDesc('bscs_career_student.score') // Order by score in descending order
                ->get();

            // Get the highest score
            $highestScore = $matchedCareers->first()->score;

            // Filter careers with the highest score
            $careersWithHighestScore = $matchedCareers->filter(function ($career) use ($highestScore) {
                return $career->score == $highestScore;
            });
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

        $skillPointsData1 = [
            $programmingAndDevelopmentPoints,
            $dataScienceAndAnalyticsPoints,
            $networkAndCybersecurityPoints,
            $designAndUserExperiencePoints,
            $devOpsandAutomationPoints,
        ];

        // Interest Skill Points
        $interestSkills = Interest::whereHas('skills')->get();

        $programmingAndDevelopmentInterests = $interestSkills->filter(function ($activity) {
            return $activity->skills->contains('skill_name', 'Programming and Development');
        });
        $dataScienceAndAnalyticsInterests = $interestSkills->filter(function ($activity) {
            return $activity->skills->contains('skill_name', 'Data Science and Analytics');
        });
        $networkAndCybersecurityInterests = $interestSkills->filter(function ($activity) {
            return $activity->skills->contains('skill_name', 'Network and Cybersecurity');
        });
        $designAndUserExperienceInterests = $interestSkills->filter(function ($activity) {
            return $activity->skills->contains('skill_name', 'Design and User Experience');
        });
        $devOpsandAutomationInterests = $activitySkills->filter(function ($activity) {
            return $activity->skills->contains('skill_name', 'DevOps and Automation');
        });

        $programmingAndDevelopmentInterestCount = 0;
        $dataScienceAndAnalyticsInterestCount = 0;
        $networkAndCybersecurityInterestCount = 0;
        $designAndUserExperienceInterestCount = 0;
        $devOpsandAutomationInterestCount = 0;

        // Count the number of interests for each skill
        foreach ($studentInterests as $interest) {
            if ($programmingAndDevelopmentInterests->contains('interest_name', $interest)) {
                $programmingAndDevelopmentInterestCount++;
            }
            if ($dataScienceAndAnalyticsInterests->contains('interest_name', $interest)) {
                $dataScienceAndAnalyticsInterestCount++;
            }
            if ($networkAndCybersecurityInterests->contains('interest_name', $interest)) {
                $networkAndCybersecurityInterestCount++;
            }
            if ($designAndUserExperienceInterests->contains('interest_name', $interest)) {
                $designAndUserExperienceInterestCount++;
            }
            if ($devOpsandAutomationInterests->contains('interest_name', $interest)) {
                $devOpsandAutomationInterestCount++;
            }
        }

        $pointsPerProgrammingAndDevelopmentInterest = 10 / $programmingAndDevelopmentInterests->count();
        $pointsPerDataScienceAndAnalyticsInterest = 10 / $dataScienceAndAnalyticsInterests->count();
        $pointsPerNetworkAndCybersecurityInterest = 10 / $networkAndCybersecurityInterests->count();
        $pointsPerDesignAndUserExperienceInterest = 10 / $designAndUserExperienceInterests->count();
        $pointsPerDevOpsandAutomationInterest = 10 / $devOpsandAutomationInterests->count();

        $programmingAndDevelopmentInterestPoints = round($programmingAndDevelopmentInterestCount * $pointsPerProgrammingAndDevelopmentInterest);
        $dataScienceAndAnalyticsInterestPoints = round($dataScienceAndAnalyticsInterestCount * $pointsPerDataScienceAndAnalyticsInterest);
        $networkAndCybersecurityInterestPoints = round($networkAndCybersecurityInterestCount * $pointsPerNetworkAndCybersecurityInterest);
        $designAndUserExperienceInterestPoints = round($designAndUserExperienceInterestCount * $pointsPerDesignAndUserExperienceInterest);
        $devOpsandAutomationInterestPoints = round($devOpsandAutomationInterestCount * $pointsPerDevOpsandAutomationInterest);

        $skillPointsData2 = [
            $programmingAndDevelopmentInterestPoints,
            $dataScienceAndAnalyticsInterestPoints,
            $networkAndCybersecurityInterestPoints,
            $designAndUserExperienceInterestPoints,
            $devOpsandAutomationInterestPoints,
        ];



        $datasetLabel1 = 'Extra Curricular Activities of ' . $studentName;
        $datasetLabel2 = 'Interest of ' . $studentName;
        $skillNames = Skill::all()->pluck('skill_name')->toArray();

        return view('recommendation', compact(
            'studentName',
            'datasetLabel1',
            'datasetLabel2',
            'studentAcademicPerformance',
            'studentPreferredCareer',
            'studentExtraCurricularActivities',
            'studentInterests',
            'careersWithHighestScore',
            'skillNames',
            'skillPointsData1',
            'skillPointsData2',
        ));
    }
}
