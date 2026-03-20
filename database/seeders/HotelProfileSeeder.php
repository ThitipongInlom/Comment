<?php

namespace Database\Seeders;

use App\Models\HotelProfile;
use Illuminate\Database\Seeder;

class HotelProfileSeeder extends Seeder
{
    public function run(): void
    {
        if (HotelProfile::count() > 0) return;

        HotelProfile::create([
            'name' => 'Default Profile',
            'title_web_en' => 'The Zign Hotel Pattaya',
            'title_web_th' => 'โรงแรมเดอะ ซายน์',
            'head_form_en' => 'Organizer/Group Leader Questionnaire',
            'head_form_th' => 'แบบสอบถามผู้นำองค์กร / กลุ่ม',
            'foot_form_en' => "I'd like to thank you on behalf of our Management for your feedback and cooperation which we'll use to improve our services.",
            'foot_form_th' => 'ในนามของฝ่ายบริหารขอขอบพระคุณสำหรับแบบสอบถาม ทางโรงแรมจะนำไปปรับปรุงเพื่อบริการที่ดียิ่งขึ้น',
            'is_active' => true,
        ]);
    }
}
