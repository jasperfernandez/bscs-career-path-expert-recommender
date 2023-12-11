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
        $bscsCareers = BscsCareer::all();
        $bscsCareersWithRelatedData = BscsCareer::with('extraCurricularActivities', 'interests')->get();
        // dd($bscsCareersWithRelatedData);
        $extraCurricularActivities = ExtraCurricularActivity::all();
        $interests = Interest::all();

        // dd($bscsCareers);

        return view('setup', compact(
            'bscsCareers',
            'extraCurricularActivities',
            'interests',
            'bscsCareersWithRelatedData',
        ));
    }

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

        // Attaching the data to pivot tables
        // $bscsCareer->extraCurricularActivities()
        //     ->syncWithoutDetaching($extracurricularActivityIds);
        // $bscsCareer->interests()
        //     ->syncWithoutDetaching($interestIds);
        $bscsCareer->extraCurricularActivities()
            ->sync($extracurricularActivityIds);
        $bscsCareer->interests()
            ->sync($interestIds);

        return redirect()
            ->route('setup')
            ->with('success', 'Attachments saved successfully.');
    }
}
