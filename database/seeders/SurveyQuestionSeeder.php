<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurveyQuestionSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('survey_questions')->count() > 0) return;

        // Get section IDs by sort_order
        $sections = DB::table('survey_sections')->pluck('id', 'sort_order');

        $questions = [
            // Section 1: The Sales Team (3 questions)
            ['section' => 1, 'sort' => 1, 'en' => 'Has the responsible sales team member been pro-actively supporting you with useful information?', 'th' => 'พนักงานฝ่ายขายที่รับผิดชอบหรือติดต่อกับท่านได้ให้การบริการและสนับสนุนในเรื่องของข้อมูลที่เป็นประโยชน์ต่อท่านอย่างกระตือรือร้นหรือไม่?'],
            ['section' => 1, 'sort' => 2, 'en' => 'Have your inquiries been replied within 24 hours?', 'th' => 'หลังจากที่ท่านมีข้อสอบถาม พนักงานฝ่ายขายได้ติดต่อกลับท่านภายใน 24 ชั่วโมงหรือไม่?'],
            ['section' => 1, 'sort' => 3, 'en' => 'Has discussed information been passed on to the team at the resort without missing any details?', 'th' => 'ข้อมูลและรายละเอียดต่างๆที่ได้รับจากท่านได้มีการสื่อสารไปยังทีมงานที่ประจำอยู่ที่โรงแรมหรือไม่?'],

            // Section 2: Upon Arrival (4 questions)
            ['section' => 2, 'sort' => 1, 'en' => 'Were you introduced to essential contacts such as the Sales Co-coordinator and the Management?', 'th' => 'ท่านได้รับการแนะนำให้รู้จักบุคคลต่างๆที่ต้องติดต่อด้วย เช่น ผู้ประสานงานฝ่ายขายและทีมงานบริหารหรือไม่?'],
            ['section' => 2, 'sort' => 2, 'en' => 'Has everyone been greeted and hearty welcomed with a cold towel and a welcome drink?', 'th' => 'ท่านได้รับการต้อนรับอย่างอบอุ่นพร้อมทั้งผ้าเย็นและเครื่องดื่มต้อนรับหรือไม่?'],
            ['section' => 2, 'sort' => 3, 'en' => 'Was the check-in process smoothly and fast?', 'th' => 'ขั้นตอนการลงทะเบียนเข้าพักเป็นไปอย่างราบรื่นและรวดเร็วหรือไม่?'],
            ['section' => 2, 'sort' => 4, 'en' => 'Has the luggage been delivered promptly?', 'th' => 'กระเป๋าเดินทางได้ถูกจัดส่งไปยังห้องพักในเวลาอันรวดเร็วหรือไม่?'],

            // Section 3: The Function (12 questions)
            ['section' => 3, 'sort' => 1, 'en' => 'Have you been invited for an inspection of the function area well before the event began?', 'th' => 'ท่านได้รับการเชื้อเชิญให้ทำการตรวจเช็คสถานที่จัดเลี้ยงหรือสัมมนาก่อนงานเริ่มหรือไม่?'],
            ['section' => 3, 'sort' => 2, 'en' => 'Was the function area prepared as per discussed requirements?', 'th' => 'สถานที่จัดเลี้ยงหรือสัมมนาได้มีการจัดเตรียมตามที่ได้ตกลงไว้หรือไม่?'],
            ['section' => 3, 'sort' => 3, 'en' => 'Were the flowers fresh and nicely presented?', 'th' => 'ดอกไม้ที่จัดให้เป็นดอกไม้สดและจัดอย่างสวยงามหรือไม่?'],
            ['section' => 3, 'sort' => 4, 'en' => 'Was there an engineer visibly on stand-by during the entire function?', 'th' => 'พนักงานแผนกช่างมีประจำอยู่ระหว่างงานจัดเลี้ยงหรือสัมมนาหรือไม่?'],
            ['section' => 3, 'sort' => 5, 'en' => 'Have all audio/visual installations worked properly?', 'th' => 'ระบบโสตทัศนอุปกรณ์ทำงานเป็นปกติหรือไม่?'],
            ['section' => 3, 'sort' => 6, 'en' => 'Was the air-condition set and working properly?', 'th' => 'ระบบเครื่องปรับอากาศทำงานเป็นปกติหรือไม่?'],
            ['section' => 3, 'sort' => 7, 'en' => 'Was the food ready on time?', 'th' => 'อาหารจัดเตรียมตรงตามเวลาหรือไม่?'],
            ['section' => 3, 'sort' => 8, 'en' => 'Was the food nicely presented?', 'th' => 'อาหารมีการจัดวางอย่างสวยงามหรือไม่?'],
            ['section' => 3, 'sort' => 9, 'en' => 'Was the food fresh and tasty?', 'th' => 'อาหารมีความสดและรสชาดเป็นที่พอใจหรือไม่?'],
            ['section' => 3, 'sort' => 10, 'en' => 'Was there enough food and empty items (buffet) refilled?', 'th' => 'อาหารเพียงพอและมีการเติมใหม่ในอาหารที่หมดทดแทนหรือไม่?'],
            ['section' => 3, 'sort' => 11, 'en' => 'Was the beverage service efficient and always present?', 'th' => 'การบริการเครื่องดื่มเป็นไปอย่างมีประสิทธิภาพและต่อเนื่องหรือไม่?'],
            ['section' => 3, 'sort' => 12, 'en' => 'Was the service staff smiling?', 'th' => 'พนักงานบริการยิ้มแย้มหรือไม่?'],

            // Section 4: The Guest Rooms (2 questions)
            ['section' => 4, 'sort' => 1, 'en' => 'Were the rooms clean and everything arranged neatly?', 'th' => 'ห้องพักสะอาดและมีการจัดเตรียมทุกอย่างเรียบร้อยหรือไม่?'],
            ['section' => 4, 'sort' => 2, 'en' => 'Have special requests through Housekeeping been fulfilled immediately?', 'th' => 'เมื่อมีการร้องขอสิ่งที่ต้องการพิเศษผ่านทางแผนกแม่บ้านท่านได้รับการตอบสนองโดยทันทีหรือไม่?'],

            // Section 5: The Departure (3 questions)
            ['section' => 5, 'sort' => 1, 'en' => 'Was the check-out process handled in timely manner?', 'th' => 'ขั้นตอนการเช็คเอาท์ เป็นไปอย่างรวดเร็วหรือไม่?'],
            ['section' => 5, 'sort' => 2, 'en' => 'Were all the bills correct and on time?', 'th' => 'ท่านได้รับใบเสร็จที่ถูกต้อง และ รวดเร็วหรือไม่?'],
            ['section' => 5, 'sort' => 3, 'en' => 'Was the luggage brought down in a timely manner?', 'th' => 'กระเป๋าเดินทางของท่านได้จัดส่งลงมาอย่างรวดเร็วหรือไม่?'],
        ];

        foreach ($questions as $q) {
            $questionId = DB::table('survey_questions')->insertGetId([
                'section_id' => $sections[$q['section']],
                'sort_order' => $q['sort'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('survey_question_translations')->insert([
                [
                    'question_id' => $questionId,
                    'locale' => 'en',
                    'text' => $q['en'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'question_id' => $questionId,
                    'locale' => 'th',
                    'text' => $q['th'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
