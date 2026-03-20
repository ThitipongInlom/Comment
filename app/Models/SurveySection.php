<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurveySection extends Model
{
    protected $fillable = ['hotel_profile_id', 'sort_order'];

    public function hotelProfile(): BelongsTo
    {
        return $this->belongsTo(HotelProfile::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(SurveySectionTranslation::class, 'section_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(SurveyQuestion::class, 'section_id')->orderBy('sort_order');
    }

    public function translation(string $locale): ?SurveySectionTranslation
    {
        return $this->translations->firstWhere('locale', $locale);
    }
}
