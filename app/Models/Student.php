<?php

namespace App\Models;

use App\Models\BscsCareer;
use App\Models\AcademicPerformance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'preferred_career_id',
        'academic_performance_id',
    ];

    public function academicPerformance(): BelongsTo
    {
        return $this->belongsTo(
            AcademicPerformance::class,
            'academic_performance_id',
        );
    }

    public function bscsCareer(): BelongsTo
    {
        return $this->belongsTo(
            BscsCareer::class,
            'preferred_career_id',
        );
    }

    public function extraCurricularActivities(): BelongsToMany
    {
        return $this->belongsToMany(
            ExtraCurricularActivity::class,
            'extra_curricular_activity_student',
            'student_id',
            'extra_curricular_activity_id'
        );
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(
            Interest::class,
            'interest_student',
            'student_id',
            'interest_id'
        );
    }
}
