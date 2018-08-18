<?php

use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->nullable();
            $table->string('remember_token')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
        date_default_timezone_set("Asia/Bangkok");
        $today = date("Y-m-d H:i:s");
        DB::table('users')->insert([[
        "name" => "Thitipong Inlom",
        "email" => "ingnice007@gmail.com", 
        "username" => "nice", 
        "password" => '$2y$10$V8OnXIkxvtKvIXGHPq9hIep0uWCURTQAMxa.urGSDFtpr.YqkMIBy', 
        "status" => "0", 
        "remember_token" => "3HluJSUdAVMPG36Y1itZNxx4rMgf20UblKH1AgmdrmROVpTFIpFMXlJQkbmU",
        "created_at" => $today,
        "updated_at" => $today,
        ]]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
