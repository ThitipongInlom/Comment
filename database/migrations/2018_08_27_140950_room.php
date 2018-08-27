<?php

use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Room extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_name')->nullable();
        });

        DB::table('setting')->insert([
        ["room_name" => "Fidella"],
        ["room_name" => "Fineen"],
        ["room_name" => "Fauna"],
        ["room_name" => "Falvio"],
        ["room_name" => "Tempara"],
        ["room_name" => "Magenta"]
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('room');
    }
}
