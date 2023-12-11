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

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            Student::class,
            'interest_student',
            'interest_id',
            'student_id',
        );
    }

    public function bscsCareers(): BelongsToMany
    {
        return $this->belongsToMany(
            BscsCareer::class,
            'bscs_career_interest',
            'interest_id',
            'bscs_career_id',
        );
    }
}
