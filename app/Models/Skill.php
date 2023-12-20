<?php

namespace App\Models;

use App\Models\Interest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['skill_name'];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            Student::class,
            'skill_student',
            'skill_id',
            'student_id'
        );
    }

    public function extraCurricularActivities(): BelongsToMany
    {
        return $this->belongsToMany(
            ExtraCurricularActivity::class,
            'extra_curricular_activity_skill',
            'skill_id',
            'extra_curricular_activity_id'
        );
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(
            Interest::class,
            'interest_skill',
            'skill_id',
            'interest_id'
        );
    }
}
