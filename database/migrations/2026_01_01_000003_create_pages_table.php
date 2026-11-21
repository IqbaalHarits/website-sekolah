<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Static rich-text pages: sejarah, sambutan, visi-misi, struktur organisasi,
     * tata tertib, kurikulum, etc. Addressed by `slug`.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('group', 30)->default('profil')->index(); // profil | akademik | kesiswaan
            $table->string('excerpt', 500)->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('author_name')->nullable();      // e.g. kepala sekolah, for sambutan
            $table->string('author_position')->nullable();
            $table->unsignedSmallInteger('order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};

