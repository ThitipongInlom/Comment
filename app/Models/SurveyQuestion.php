<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurveyQuestion extends Model
{
    protected $fillable = ['section_id', 'sort_order'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(SurveySection::class, 'section_id');
    }

    public function translations(): HasMany
    {
        return $this->hasMany(SurveyQuestionTranslation::class, 'question_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(SurveyAnswer::class, 'question_id');
    }

    public function translation(string $locale): ?SurveyQuestionTranslation
    {
        return $this->translations->firstWhere('locale', $locale);
    }
}
