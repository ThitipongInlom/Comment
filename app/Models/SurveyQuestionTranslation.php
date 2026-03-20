<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurveyQuestionTranslation extends Model
{
    protected $fillable = ['question_id', 'locale', 'text'];

    public function question(): BelongsTo
    {
        return $this->belongsTo(SurveyQuestion::class, 'question_id');
    }
}
