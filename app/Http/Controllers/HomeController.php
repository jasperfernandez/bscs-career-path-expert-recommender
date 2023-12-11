<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Interest;
use App\Models\BscsCareer;
use Illuminate\Http\Request;
use App\Models\AcademicPerformance;
use App\Models\ExtraCurricularActivity;

class HomeController extends Controller
{
    public function index()
    {
        $bscsCareers = BscsCareer::all();
        $academicPerformances = AcademicPerformance::all();
        $extraCurricularActivities = ExtraCurricularActivity::all();
        $interests = Interest::all();

        return view('index', compact(
            'bscsCareers',
            'academicPerformances',
            'extraCurricularActivities',
            'interests',
        ));
    }

    public function handleRecommend(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'academic-performance' => 'required|exists:academic_performances,id',
            'interests' => 'required|array',
            'interests.*' => 'exists:interests,id',
            'preferred-career' => 'required|exists:bscs_careers,id',
            'extra-curricular-activities' => 'required|array',
            'extra-curricular-activities.*' => 'exists:extra_curricular_activities,id',
        ]);
        // dd($request);

        // create the student
        $studentName = $request->input('name');
        $academicPerformanceId = $request->input('academic-performance');
        $preferredCareerId = $request->input('preferred-career');

        $student = Student::where('name', $studentName)->first();
        if ($student) {

            // attach the extra curricular activities student
            $extraCurricularActivities = $request->input('extra-curricular-activities');
            $student->extraCurricularActivities()->sync($extraCurricularActivities);

            // // attach the interests of student
            $interests = $request->input('interests');
            $student->interests()->sync($interests);
            return redirect()
                ->route('home')
                ->with('success', 'Student record updated successfuly.');
        }

        $newStudent = Student::create([
            'name' => $studentName,
            'academic_performance_id' => $academicPerformanceId,
            'preferred_career_id' => $preferredCareerId,
        ]);

        // dd($student);
        // attach the extra curricular activities student
        $extraCurricularActivities = $request->input('extra-curricular-activities');
        $newStudent->extraCurricularActivities()->sync($extraCurricularActivities);

        // attach the interests of student
        $interests = $request->input('interests');
        $newStudent->interests()->sync($interests);

        return redirect()
            ->route('home')
            ->with('success', 'Saved successfully.');
    }

    public function getRadarChartData()
    {
        //
    }
}
