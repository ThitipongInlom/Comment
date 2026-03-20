<?php

namespace App\Http\Controllers;

use App\Models\HotelProfile;
use App\Models\SurveyLink;
use App\Models\SurveyResponse;
use App\Models\SurveySection;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SurveyController extends Controller
{
    public function show(string $locale, string $slug): Response|\Illuminate\Http\RedirectResponse
    {
        $link = SurveyLink::where('slug', $slug)->with('room.hotelProfile')->first();

        if (!$link || !$link->is_active) {
            return redirect('/404');
        }

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

        return Inertia::render('Survey/Show', [
            'link' => $link,
            'sections' => $sections,
            'settings' => $settings,
            'locale' => $locale,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'survey_link_id' => 'required|exists:survey_links,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'overall_rating' => 'nullable|integer|min:1|max:5',
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:survey_questions,id',
            'answers.*.answer' => 'nullable|string|max:20',
            'answers.*.comment' => 'nullable|string|max:5000',
            'locale' => 'required|in:en,th',
        ]);

        $link = SurveyLink::findOrFail($validated['survey_link_id']);

        // Calculate next response number
        $nextNumber = ($link->responses()->max('response_number') ?? 0) + 1;

        $response = SurveyResponse::create([
            'survey_link_id' => $link->id,
            'response_number' => $nextNumber,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'telephone' => $validated['telephone'] ?? null,
            'email' => $validated['email'] ?? null,
            'overall_rating' => $validated['overall_rating'] ?? null,
            'submitted_at' => now(),
        ]);

        // Bulk insert answers
        $answers = collect($validated['answers'])->map(fn ($a) => [
            'response_id' => $response->id,
            'question_id' => $a['question_id'],
            'answer' => $a['answer'] ?? null,
            'comment' => $a['comment'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();

        $response->answers()->insert($answers);

        $slug = $link->slug;
        $locale = $validated['locale'];

        return redirect("/{$locale}/{$slug}/{$nextNumber}")
            ->with('success', $locale === 'th' ? 'ส่งแบบสอบถามสำเร็จ' : 'Survey submitted successfully');
    }
}
