<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurveySectionTranslation extends Model
{
    protected $fillable = ['section_id', 'locale', 'title'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(SurveySection::class, 'section_id');
    }
}
