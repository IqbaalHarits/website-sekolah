<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Program unggulan (kurikulum) & ekstrakurikuler share one table, split by `type`.
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('type', ['program_unggulan', 'ekstrakurikuler'])->default('program_unggulan');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('icon', 60)->nullable(); // heroicon name, optional
            $table->string('schedule_info')->nullable(); // e.g. "Setiap Sabtu, 15.30"
            $table->unsignedSmallInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['type', 'is_active', 'order']);
        });

        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('student_name')->nullable();
            $table->string('level', 40)->nullable(); // Sekolah, Kecamatan, Kabupaten, Provinsi, Nasional, Internasional
            $table->string('rank', 60)->nullable();  // Juara 1, Medali Emas, ...
            $table->year('year');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('programs');
    }
};

