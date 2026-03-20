<?php

namespace App\Http\Controllers;

use App\Models\HotelProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class HotelProfileController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/HotelProfiles/Index', [
            'profiles' => HotelProfile::orderByDesc('is_active')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title_web_en' => 'required|string|max:255',
            'title_web_th' => 'required|string|max:255',
            'head_form_en' => 'required|string|max:255',
            'head_form_th' => 'required|string|max:255',
            'foot_form_en' => 'nullable|string|max:5000',
            'foot_form_th' => 'nullable|string|max:5000',
            'logo' => 'nullable|image|max:2048',
            'background' => 'nullable|image|max:5120',
        ]);

        $data = collect($validated)->except(['logo', 'background'])->toArray();

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('hotel-profiles', 'public');
        }

        if ($request->hasFile('background')) {
            $data['background_path'] = $request->file('background')->store('hotel-profiles', 'public');
        }

        HotelProfile::create($data);

        return back()->with('success', 'Profile created successfully');
    }

    public function update(Request $request, HotelProfile $hotelProfile)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title_web_en' => 'required|string|max:255',
            'title_web_th' => 'required|string|max:255',
            'head_form_en' => 'required|string|max:255',
            'head_form_th' => 'required|string|max:255',
            'foot_form_en' => 'nullable|string|max:5000',
            'foot_form_th' => 'nullable|string|max:5000',
            'logo' => 'nullable|image|max:2048',
            'background' => 'nullable|image|max:5120',
            'remove_logo' => 'nullable|boolean',
            'remove_background' => 'nullable|boolean',
        ]);

        $data = collect($validated)->except(['logo', 'background', 'remove_logo', 'remove_background'])->toArray();

        // Handle logo
        if ($request->hasFile('logo')) {
            if ($hotelProfile->logo_path) {
                Storage::disk('public')->delete($hotelProfile->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('hotel-profiles', 'public');
        } elseif ($request->boolean('remove_logo')) {
            if ($hotelProfile->logo_path) {
                Storage::disk('public')->delete($hotelProfile->logo_path);
            }
            $data['logo_path'] = null;
        }

        // Handle background
        if ($request->hasFile('background')) {
            if ($hotelProfile->background_path) {
                Storage::disk('public')->delete($hotelProfile->background_path);
            }
            $data['background_path'] = $request->file('background')->store('hotel-profiles', 'public');
        } elseif ($request->boolean('remove_background')) {
            if ($hotelProfile->background_path) {
                Storage::disk('public')->delete($hotelProfile->background_path);
            }
            $data['background_path'] = null;
        }

        $hotelProfile->update($data);

        return back()->with('success', 'Profile updated successfully');
    }

    public function destroy(HotelProfile $hotelProfile)
    {
        if ($hotelProfile->is_active) {
            return back()->with('error', 'Cannot delete the active profile');
        }

        if ($hotelProfile->logo_path) {
            Storage::disk('public')->delete($hotelProfile->logo_path);
        }
        if ($hotelProfile->background_path) {
            Storage::disk('public')->delete($hotelProfile->background_path);
        }

        $hotelProfile->delete();

        return back()->with('success', 'Profile deleted successfully');
    }

    public function activate(HotelProfile $hotelProfile)
    {
        $hotelProfile->activate();

        return back()->with('success', 'Profile activated successfully');
    }
}
