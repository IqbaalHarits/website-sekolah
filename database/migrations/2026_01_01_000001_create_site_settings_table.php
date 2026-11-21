<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Single-row table holding global website configuration.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('tagline')->nullable();
            $table->text('about_summary')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('whatsapp', 30)->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->text('map_embed_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('ppdb_url')->nullable();
            $table->boolean('ppdb_is_open')->default(false);
            $table->string('ppdb_headline')->nullable();
            $table->text('ppdb_description')->nullable();
            $table->date('ppdb_deadline')->nullable();
            $table->string('meta_description', 300)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};

