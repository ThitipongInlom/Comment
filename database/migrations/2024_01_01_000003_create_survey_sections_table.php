<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('survey_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_profile_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('sort_order')->unsigned();
            $table->timestamps();
        });

        Schema::create('survey_section_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('survey_sections')->cascadeOnDelete();
            $table->string('locale', 5);
            $table->string('title');
            $table->timestamps();

            $table->unique(['section_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_section_translations');
        Schema::dropIfExists('survey_sections');
    }
};
