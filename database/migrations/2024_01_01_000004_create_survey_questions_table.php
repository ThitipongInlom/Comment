<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('survey_sections')->cascadeOnDelete();
            $table->tinyInteger('sort_order')->unsigned();
            $table->timestamps();

            $table->index(['section_id', 'sort_order']);
        });

        Schema::create('survey_question_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('survey_questions')->cascadeOnDelete();
            $table->string('locale', 5);
            $table->text('text');
            $table->timestamps();

            $table->unique(['question_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_question_translations');
        Schema::dropIfExists('survey_questions');
    }
};
