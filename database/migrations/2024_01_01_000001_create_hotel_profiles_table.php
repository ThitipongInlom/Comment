<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title_web_en')->default('');
            $table->string('title_web_th')->default('');
            $table->string('head_form_en')->default('');
            $table->string('head_form_th')->default('');
            $table->text('foot_form_en')->nullable();
            $table->text('foot_form_th')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('background_path')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_profiles');
    }
};
