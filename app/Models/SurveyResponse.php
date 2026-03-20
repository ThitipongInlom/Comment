<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurveyResponse extends Model
{
    protected $fillable = [
        'survey_link_id',
        'response_number',
        'first_name',
        'last_name',
        'telephone',
        'email',
        'overall_rating',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
            'overall_rating' => 'integer',
            'response_number' => 'integer',
        ];
    }

    public function surveyLink(): BelongsTo
    {
        return $this->belongsTo(SurveyLink::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(SurveyAnswer::class, 'response_id');
    }
}
