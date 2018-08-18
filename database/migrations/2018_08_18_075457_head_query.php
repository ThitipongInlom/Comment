<?php

use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HeadQuery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('head_query', function (Blueprint $table) {
            $table->increments('id');
            $table->string('head_id_sub')->nullable();
            $table->string('lang')->nullable();
            $table->string('detail')->nullable();
        });

       DB::table('head_query')->insert([
        ["head_id_sub" => "1", "lang" => "en", "detail" => "The Sales Team"],
        ["head_id_sub" => "1", "lang" => "th", "detail" => "ทีมขาย"],
        ["head_id_sub" => "2", "lang" => "en", "detail" => "Upon Arrival"],
        ["head_id_sub" => "2", "lang" => "th", "detail" => "เมื่อเดินทางมาถึง"],
        ["head_id_sub" => "3", "lang" => "en", "detail" => "The Function"],
        ["head_id_sub" => "3", "lang" => "th", "detail" => "ฟังก์ชั่น"],
        ["head_id_sub" => "4", "lang" => "en", "detail" => "The Guest Rooms"],
        ["head_id_sub" => "4", "lang" => "th", "detail" => "ห้องพัก"],
        ["head_id_sub" => "5", "lang" => "en", "detail" => "The Departure"],
        ["head_id_sub" => "5", "lang" => "th", "detail" => "ขาออก"],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('head_query');
    }
}
