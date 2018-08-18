<?php

use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Setting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('Setting_id');
            $table->string('Setting_head')->nullable();
            $table->string('Setting_land')->nullable();
            $table->string('Setting_detail')->nullable();
        });

        DB::table('setting')->insert([
        ["Setting_head" => "title_web", "Setting_land" => "en", "Setting_detail" => "The Zign Hotel Pattaya"],
        ["Setting_head" => "head_form", "Setting_land" => "en", "Setting_detail" => "Organizer/Group Leader Questionnaire"],
        ["Setting_head" => "title_web", "Setting_land" => "th", "Setting_detail" => "โรงแรมเดอะ ซายน์"],
        ["Setting_head" => "head_form", "Setting_land" => "th", "Setting_detail" => "แบบสอบถามผู้นำองค์กร / กลุ่ม"],
        ["Setting_head" => "foot_form", "Setting_land" => "en", "Setting_detail" => "l'd like to thank you on behalf of our Management for you feedback and cooperation which we'll use to improve our"],
        ["Setting_head" => "foot_form", "Setting_land" => "th", "Setting_detail" => "ในนามของฝ่ายบริหารขอขอบพระคุณสำหรับแบบสอบถาม ทางโรงแรมจะนำไปปรับปรุงเพื่อบริการที่ดียิ่งขึ้น"],
        ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('setting');
    }
}
