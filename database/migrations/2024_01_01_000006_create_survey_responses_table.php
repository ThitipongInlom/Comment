<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_link_id')->constrained('survey_links')->cascadeOnDelete();
            $table->unsignedInteger('response_number');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('telephone', 50)->nullable();
            $table->string('email')->nullable();
            $table->unsignedTinyInteger('overall_rating')->nullable();
            $table->timestamp('submitted_at');
            $table->timestamps();

            $table->unique(['survey_link_id', 'response_number']);
        });

        Schema::create('survey_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('response_id')->constrained('survey_responses')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('survey_questions')->cascadeOnDelete();
            $table->string('answer', 20)->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->unique(['response_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_answers');
        Schema::dropIfExists('survey_responses');
    }
};
