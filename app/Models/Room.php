<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = ['name', 'hotel_profile_id'];

    public function hotelProfile(): BelongsTo
    {
        return $this->belongsTo(HotelProfile::class);
    }

    public function surveyLinks(): HasMany
    {
        return $this->hasMany(SurveyLink::class);
    }
}
