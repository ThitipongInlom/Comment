<?php

namespace Database\Seeders;

use App\Models\HotelProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurveySectionSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('survey_sections')->count() > 0) return;

        $profileId = HotelProfile::first()?->id;

        $sections = [
            ['sort_order' => 1, 'en' => 'The Sales Team', 'th' => 'ทีมขาย'],
            ['sort_order' => 2, 'en' => 'Upon Arrival', 'th' => 'เมื่อเดินทางมาถึง'],
            ['sort_order' => 3, 'en' => 'The Function', 'th' => 'ฟังก์ชั่น'],
            ['sort_order' => 4, 'en' => 'The Guest Rooms', 'th' => 'ห้องพัก'],
            ['sort_order' => 5, 'en' => 'The Departure', 'th' => 'ขาออก'],
        ];

        foreach ($sections as $section) {
            $sectionId = DB::table('survey_sections')->insertGetId([
                'hotel_profile_id' => $profileId,
                'sort_order' => $section['sort_order'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('survey_section_translations')->insert([
                [
                    'section_id' => $sectionId,
                    'locale' => 'en',
                    'title' => $section['en'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'section_id' => $sectionId,
                    'locale' => 'th',
                    'title' => $section['th'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
