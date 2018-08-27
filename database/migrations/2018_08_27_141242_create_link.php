<?php

use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_link', function (Blueprint $table) {
            $table->increments('link_id');
            $table->date('link_create');
            $table->string('link_room')->nullable();
            $table->string('link_group_name')->nullable();
            $table->date('link_staying_from');
            $table->date('link_staying_to');
            $table->string('link_encode')->nullable();
            $table->string('link_gust_in')->nullable();
            $table->string('link_en')->nullable();
            $table->string('link_th')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('create_link');
    }
}
