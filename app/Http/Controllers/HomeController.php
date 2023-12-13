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

    public function createStudent(Request $request)
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

        $studentName = $request->input('name');
        $academicPerformanceId = $request->input('academic-performance');
        $preferredCareerId = $request->input('preferred-career');

        // find if student already exists
        $student = Student::where('name', $studentName)->first();
        // student already exists just update the student record
        if ($student) {
            // attach the extra curricular activities student
            $extraCurricularActivities = $request->input('extra-curricular-activities');
            $student->extraCurricularActivities()->sync($extraCurricularActivities);
            // attach the interests of student
            $interests = $request->input('interests');
            $student->interests()->sync($interests);

            $studentId = $student->id;
            return redirect()->route('recommendation', ['studentId' => $studentId]);
        }

        // create new student record
        $newStudent = Student::create([
            'name' => $studentName,
            'academic_performance_id' => $academicPerformanceId,
            'preferred_career_id' => $preferredCareerId,
        ]);
        // attach the extra curricular activities student
        $extraCurricularActivities = $request->input('extra-curricular-activities');
        $newStudent->extraCurricularActivities()->sync($extraCurricularActivities);
        // attach the interests of student
        $interests = $request->input('interests');
        $newStudent->interests()->sync($interests);

        $studentId = $newStudent->id;
        return redirect()->route('recommendation', ['studentId' => $studentId]);
    }
}
