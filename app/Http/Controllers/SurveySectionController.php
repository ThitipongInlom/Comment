<?php

namespace App\Http\Controllers;

use App\Models\HotelProfile;
use App\Models\SurveySection;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SurveySectionController extends Controller
{
    public function index(Request $request): Response
    {
        $profiles = HotelProfile::orderBy('name')->get();
        $selectedProfileId = $request->query('profile_id');

        if (!$selectedProfileId && $profiles->isNotEmpty()) {
            $active = $profiles->firstWhere('is_active', true);
            $selectedProfileId = $active ? $active->id : $profiles->first()->id;
        }

        $sections = $selectedProfileId
            ? SurveySection::where('hotel_profile_id', $selectedProfileId)
                ->with([
                    'translations',
                    'questions' => fn ($q) => $q->orderBy('sort_order'),
                    'questions.translations',
                ])
                ->withCount('questions')
                ->orderBy('sort_order')
                ->get()
            : collect();

        return Inertia::render('Admin/SurveySections/Index', [
            'sections' => $sections,
            'profiles' => $profiles,
            'selectedProfileId' => (int) $selectedProfileId,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hotel_profile_id' => 'required|exists:hotel_profiles,id',
            'title_en' => 'required|string|max:255',
            'title_th' => 'required|string|max:255',
        ]);

        $nextOrder = SurveySection::where('hotel_profile_id', $validated['hotel_profile_id'])
            ->max('sort_order') + 1;

        $section = SurveySection::create([
            'hotel_profile_id' => $validated['hotel_profile_id'],
            'sort_order' => $nextOrder,
        ]);

        $section->translations()->createMany([
            ['locale' => 'en', 'title' => $validated['title_en']],
            ['locale' => 'th', 'title' => $validated['title_th']],
        ]);

        return back()->with('success', 'Section created successfully');
    }

    public function update(Request $request, SurveySection $surveySection)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_th' => 'required|string|max:255',
        ]);

        $surveySection->translations()->updateOrCreate(
            ['locale' => 'en'],
            ['title' => $validated['title_en']]
        );
        $surveySection->translations()->updateOrCreate(
            ['locale' => 'th'],
            ['title' => $validated['title_th']]
        );

        return back()->with('success', 'Section updated successfully');
    }

    public function destroy(SurveySection $surveySection)
    {
        if ($surveySection->questions()->whereHas('answers')->exists()) {
            return back()->with('error', 'Cannot delete section that has questions with survey responses');
        }

        $surveySection->delete();

        return back()->with('success', 'Section deleted successfully');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:survey_sections,id',
            'items.*.sort_order' => 'required|integer|min:1',
        ]);

        foreach ($validated['items'] as $item) {
            SurveySection::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return back();
    }
}
