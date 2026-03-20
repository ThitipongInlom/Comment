<?php

namespace Database\Seeders;

use App\Models\HotelProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('rooms')->count() > 0) return;

        $profileId = HotelProfile::first()?->id;
        $rooms = ['Fidella', 'Fineen', 'Fauna', 'Falvio', 'Tempara', 'Magenta'];

        foreach ($rooms as $room) {
            DB::table('rooms')->insert([
                'name' => $room,
                'hotel_profile_id' => $profileId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
