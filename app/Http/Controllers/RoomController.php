<?php

namespace App\Http\Controllers;

use App\Models\HotelProfile;
use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RoomController extends Controller
{
    public function index(Request $request): Response
    {
        $profiles = HotelProfile::orderBy('name')->get();
        $selectedProfileId = $request->query('profile_id');

        if (!$selectedProfileId && $profiles->isNotEmpty()) {
            $active = $profiles->firstWhere('is_active', true);
            $selectedProfileId = $active ? $active->id : $profiles->first()->id;
        }

        $rooms = $selectedProfileId
            ? Room::where('hotel_profile_id', $selectedProfileId)
                ->withCount('surveyLinks')
                ->orderBy('name')
                ->get()
            : collect();

        return Inertia::render('Admin/Rooms/Index', [
            'rooms' => $rooms,
            'profiles' => $profiles,
            'selectedProfileId' => (int) $selectedProfileId,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'hotel_profile_id' => 'required|exists:hotel_profiles,id',
        ]);

        Room::create($validated);

        return back()->with('success', 'Room created successfully');
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name,' . $room->id,
        ]);

        $room->update($validated);

        return back()->with('success', 'Room updated successfully');
    }

    public function destroy(Room $room)
    {
        if ($room->surveyLinks()->exists()) {
            return back()->with('error', 'Cannot delete room that has survey links');
        }

        $room->delete();

        return back()->with('success', 'Room deleted successfully');
    }
}
