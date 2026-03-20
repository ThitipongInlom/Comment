<?php

namespace App\Http\Controllers;

use App\Models\HotelProfile;
use App\Models\Room;
use App\Models\SurveyLink;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class SurveyLinkController extends Controller
{
    public function index(Request $request): Response
    {
        $profiles = HotelProfile::orderBy('name')->get();
        $selectedProfileId = $request->query('profile_id');

        if (!$selectedProfileId && $profiles->isNotEmpty()) {
            $active = $profiles->firstWhere('is_active', true);
            $selectedProfileId = $active ? $active->id : $profiles->first()->id;
        }

        $linksQuery = SurveyLink::with('room')
            ->withCount('responses')
            ->orderByDesc('created_at');

        if ($selectedProfileId) {
            $linksQuery->whereHas('room', fn ($q) => $q->where('hotel_profile_id', $selectedProfileId));
        }

        $rooms = $selectedProfileId
            ? Room::where('hotel_profile_id', $selectedProfileId)->orderBy('name')->get()
            : collect();

        return Inertia::render('Admin/SurveyLinks/Index', [
            'links' => $linksQuery->get(),
            'rooms' => $rooms,
            'profiles' => $profiles,
            'selectedProfileId' => (int) $selectedProfileId,
        ]);
    }

    public function create(): Response
    {
        $activeProfile = HotelProfile::getActive();
        $rooms = $activeProfile
            ? Room::where('hotel_profile_id', $activeProfile->id)->orderBy('name')->get()
            : Room::orderBy('name')->get();

        return Inertia::render('Admin/CreateLink', [
            'rooms' => $rooms,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'guest_count' => 'required|integer|min:1',
            'room_id' => 'required|exists:rooms,id',
            'staying_from' => 'required|date',
            'staying_to' => 'required|date|after_or_equal:staying_from',
        ]);

        $slug = Str::slug($validated['group_name']) . '-' . Str::random(6);

        SurveyLink::create(array_merge($validated, [
            'slug' => $slug,
        ]));

        return redirect('/admin/survey-links')->with('success', 'สร้างลิงก์สำเร็จ');
    }

    public function toggleStatus(SurveyLink $surveyLink)
    {
        $surveyLink->update([
            'is_active' => !$surveyLink->is_active,
        ]);

        return back();
    }

    public function responses(Request $request, SurveyLink $surveyLink)
    {
        $responses = $surveyLink->responses()
            ->with('answers.question.translations')
            ->orderBy('response_number')
            ->get();

        if ($request->wantsJson()) {
            return response()->json([
                'link' => $surveyLink->load('room'),
                'responses' => $responses,
            ]);
        }

        return Inertia::render('Admin/Responses', [
            'link' => $surveyLink->load('room'),
            'responses' => $responses,
        ]);
    }
}
