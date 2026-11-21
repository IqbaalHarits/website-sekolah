<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Database\Seeders\Support\PlaceholderImage;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        Gallery::query()->delete();

        $rows = [
            ['Upacara Hari Santri', 'kegiatan'], ['Kelas Tahfidz Pagi', 'akademik'], ['Latihan Pencak Silat', 'ekstrakurikuler'],
            ['Salat Berjamaah di Masjid', 'keagamaan'], ['Laboratorium IPA', 'fasilitas'], ['Wisuda Tahfidz', 'wisuda'],
            ['Pramuka di Alam Terbuka', 'ekstrakurikuler'], ['Kajian Kitab Ba\'da Subuh', 'keagamaan'],
            ['Perpustakaan Pesantren', 'fasilitas'], ['Pekan Olahraga & Seni', 'kegiatan'],
            ['Diskusi Kelas Bahasa', 'akademik'], ['Haflah Akhirussanah', 'wisuda'],
        ];

        foreach ($rows as $i => [$title, $cat]) {
            Gallery::create([
                'title' => $title, 'category' => $cat, 'order' => $i,
                'image' => PlaceholderImage::make('seed/galleries', 'galeri-'.($i + 1), 1000, $i % 3 === 0 ? 1300 : 750, $i),
                'taken_at' => now()->subDays($i * 11), 'is_active' => true,
            ]);
        }
    }
}
