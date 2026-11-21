<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // tahunan = Jadwal Kegiatan Tahunan, kalender_akademik = Kalender Akademik
            $table->enum('category', ['tahunan', 'kalender_akademik'])->default('tahunan');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['category', 'is_active', 'start_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_schedules');
    }
};

