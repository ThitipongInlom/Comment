<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class HotelProfile extends Model
{
    protected $fillable = [
        'name',
        'title_web_en',
        'title_web_th',
        'head_form_en',
        'head_form_th',
        'foot_form_en',
        'foot_form_th',
        'logo_path',
        'background_path',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected $appends = ['logo_url', 'background_url'];

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_path ? Storage::url($this->logo_path) : null;
    }

    public function getBackgroundUrlAttribute(): ?string
    {
        return $this->background_path ? Storage::url($this->background_path) : null;
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function surveySections(): HasMany
    {
        return $this->hasMany(SurveySection::class);
    }

    public static function getActive(): ?self
    {
        return static::where('is_active', true)->first();
    }

    public function activate(): void
    {
        static::where('is_active', true)->update(['is_active' => false]);
        $this->update(['is_active' => true]);
    }

    public function getSettingsForLocale(string $locale): array
    {
        $suffix = $locale === 'th' ? 'th' : 'en';

        return [
            'title' => $this->{"title_web_{$suffix}"},
            'head_form' => $this->{"head_form_{$suffix}"},
            'foot_form' => $this->{"foot_form_{$suffix}"},
            'logo_url' => $this->logo_url,
            'background_url' => $this->background_url,
        ];
    }
}
