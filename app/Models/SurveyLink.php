<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurveyLink extends Model
{
    protected $fillable = [
        'room_id',
        'group_name',
        'guest_count',
        'staying_from',
        'staying_to',
        'slug',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'staying_from' => 'date',
            'staying_to' => 'date',
            'is_active' => 'boolean',
            'guest_count' => 'integer',
        ];
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(SurveyResponse::class);
    }

    public function getEnUrlAttribute(): string
    {
        return "/en/{$this->slug}";
    }

    public function getThUrlAttribute(): string
    {
        return "/th/{$this->slug}";
    }
}
