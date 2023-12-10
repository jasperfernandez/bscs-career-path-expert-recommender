<?php

namespace App\Models;

use App\Models\BscsCareer;
use App\Models\ExtraCurricularActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = [
        'interest_name',
    ];

    // extra_curricular_activity_interest_student table relationship
    public function studentExtraCurricularActivities(): BelongsToMany
    {
        return $this->belongsToMany(
            ExtraCurricularActivity::class,
            'extra_curricular_activity_interest_student',
            'interest_id',
            'extra_curricular_activity_id'
        )->withPivot('student_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            Student::class,
            'extra_curricular_activity_interest_student',
            'interest_id',
            'student_id'
        )->withPivot('extra_curricular_activity_id');
    }
    //end of extra_curricular_activity_interest_student table relationship

    // bscs_career_extra_curricular_activity_interest table relationship
    public function bscsCareers(): BelongsToMany
    {
        return $this->belongsToMany(
            BscsCareer::class,
            'bscs_career_extra_curricular_activity_interest',
            'interest_id',
            'bscs_career_id'
        )->withPivot('extra_curricular_activity_id');
    }

    public function extraCurricularActivities(): BelongsToMany
    {
        return $this->belongsToMany(
            ExtraCurricularActivity::class,
            'bscs_career_extra_curricular_activity_interest',
            'interest_id',
            'extra_curricular_activity_id'
        )->withPivot('bscs_career_id');
    }
    // end of bscs_career_extra_curricular_activity_interest table relationship
}
