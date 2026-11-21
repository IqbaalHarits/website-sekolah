<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('featured_alumni', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->year('graduation_year');
            $table->string('current_position')->nullable();
            $table->string('photo')->nullable();
            $table->text('testimonial');
            $table->text('success_story')->nullable();
            $table->unsignedSmallInteger('order')->default(0);
            $table->boolean('is_featured')->default(true);
            $table->timestamps();

            $table->index(['is_featured', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('featured_alumni');
    }
};

