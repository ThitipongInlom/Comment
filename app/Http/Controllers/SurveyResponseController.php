<?php

namespace App\Http\Controllers;

use App\Models\HotelProfile;
use App\Models\SurveyLink;
use App\Models\SurveyResponse;
use App\Models\SurveySection;
use Inertia\Inertia;
use Inertia\Response;

class SurveyResponseController extends Controller
{
    public function show(string $locale, string $slug, int $responseNumber): Response|\Illuminate\Http\RedirectResponse
    {
        $link = SurveyLink::where('slug', $slug)->with('room.hotelProfile')->first();

        if (!$link) {
            return redirect('/404');
        }

        $response = SurveyResponse::where('survey_link_id', $link->id)
            ->where('response_number', $responseNumber)
            ->with('answers')
            ->first();

        if (!$response) {
            return redirect('/404');
        }

        $totalResponses = $link->responses()->count();
        $profile = $link->room?->hotelProfile;

        $sections = $profile
            ? SurveySection::where('hotel_profile_id', $profile->id)
                ->with([
                    'translations' => fn ($q) => $q->where('locale', $locale),
                    'questions' => fn ($q) => $q->orderBy('sort_order'),
                    'questions.translations' => fn ($q) => $q->where('locale', $locale),
                ])->has('questions')->orderBy('sort_order')->get()
            : collect();

        $settings = $profile
            ? $profile->getSettingsForLocale($locale)
            : ['title' => '', 'head_form' => '', 'foot_form' => '', 'logo_url' => null, 'background_url' => null];

        return Inertia::render('Survey/Response', [
            'link' => $link,
            'response' => $response,
            'sections' => $sections,
            'settings' => $settings,
            'locale' => $locale,
            'totalResponses' => $totalResponses,
            'currentNumber' => $responseNumber,
        ]);
    }
}
