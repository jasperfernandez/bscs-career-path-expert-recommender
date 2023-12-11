<?php

namespace App\Http\Controllers;

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

    public function handleRecommend()
    {
        //
    }

    public function getRadarChartData()
    {
        //
    }
}
