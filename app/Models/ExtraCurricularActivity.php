<?php

namespace App\Models;

use App\Models\Interest;
use App\Models\BscsCareer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExtraCurricularActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'extra_curricular_activity_name',
    ];

    // extra_curricular_activity_interest_student table relationship
    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'extra_curricular_activity_student',
            'extra_curricular_activity_id',
            'student_id'
        );
    }

    public function bscsCareers()
    {
        return $this->belongsToMany(
            BscsCareer::class,
            'bscs_career_extra_curricular_activity',
            'extra_curricular_activity_id',
            'bscs_career_id'
        );
    }
}
