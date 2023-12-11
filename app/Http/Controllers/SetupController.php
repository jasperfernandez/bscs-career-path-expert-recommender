<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\BscsCareer;
use Illuminate\Http\Request;
use App\Models\ExtraCurricularActivity;

class SetupController extends Controller
{
    public function index()
    {
        $bscsCareers = BscsCareer::with('extraCurricularActivities', 'interests')->get();
        $extraCurricularActivities = ExtraCurricularActivity::all();
        $interests = Interest::all();

        // dd($bscsCareers);

        return view('setup', compact(
            'bscsCareers',
            'extraCurricularActivities',
            'interests',
        ));
    }
    // public function index()
    // {
    //     $bscsCareers = BscsCareer::all();
    //     $extraCurricularActivities = ExtraCurricularActivity::all();
    //     $interests = Interest::all();

    //     // $careerExtraCurricularActivities = BscsCareer::with('extraCurricularActivities')->get();
    //     // Load the pivot table data along with the relationships
    //     foreach ($bscsCareers as $bscsCareer) {
    //         $bscsCareer->load(['extraCurricularActivities', 'interests']);
    //     }
    //     // TODO: Add the code to get the PIVOT table data from the database

    //     return view('setup', compact(
    //         'bscsCareers',
    //         'extraCurricularActivities',
    //         'interests',
    //         // 'careerExtraCurricularActivities',
    //     ));
    // }

    public function handleAttach(Request $request)
    {
        $request->validate([
            'career-name' => 'required',
            'extra-curricular-activities' => 'required|array',
            'extra-curricular-activities.*' => 'exists:extra_curricular_activities,id',
            'interests' => 'required|array',
            'interests.*' => 'exists:interests,id',
        ]);

        // dd($request->all());
        $careerId = $request->input('career-name');
        $extracurricularActivityIds = $request->input('extra-curricular-activities');
        $interestIds = $request->input('interests');

        // Find the BSCS career by its ID
        $bscsCareer = BscsCareer::find($careerId);

        // Attaching the data to pivot table
        $bscsCareer->extraCurricularActivities()->sync($extracurricularActivityIds, ['interest_id' => $interestIds]);

        return redirect()->route('setup')->with('success', 'Attachments saved successfully.');;
    }
}
