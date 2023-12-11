<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Interest;
use App\Models\ExtraCurricularActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BscsCareer extends Model
{
    use HasFactory;

    protected $fillable = [
        'bscs_career_name',
        'difficulty',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(
            Student::class, // related model
            'preferred_career_id', // foreign key column name of the related model
            'id', // local key of the current model
        );
    }

    public function extraCurricularActivities(): BelongsToMany
    {
        return $this->belongsToMany(
            ExtraCurricularActivity::class, // related model
            'bscs_career_extra_curricular_activity', // pivot table name
            'bscs_career_id', // foreign key of the current model
            'extra_curricular_activity_id', // foreign key of the related model
        );
    }

    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(
            Interest::class,  // related model
            'bscs_career_extra_curricular_activity_interest',  // pivot table name
            'bscs_career_id', // foreign key of the current model
            'interest_id', // foreign key of the related model
        );
    }
}
