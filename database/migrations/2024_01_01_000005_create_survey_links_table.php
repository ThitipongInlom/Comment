<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('survey_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->nullable()->constrained('rooms')->nullOnDelete();
            $table->string('group_name');
            $table->unsignedInteger('guest_count');
            $table->date('staying_from');
            $table->date('staying_to');
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_links');
    }
};
