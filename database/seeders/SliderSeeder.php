<?php

namespace Database\Seeders;

use App\Models\Slider;
use Database\Seeders\Support\BrandAssets;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        Slider::query()->delete();

        // Foto gedung madrasah. Tambahkan slide lain melalui Admin → Slider / Hero.
        Slider::create([
            'title' => 'Membangun Generasi Berilmu dan Berakhlak Mulia',
            'subtitle' => 'Lingkungan belajar yang asri dan kondusif, memadukan pendidikan agama dan umum di Bumijawa, Kabupaten Tegal.',
            'image' => BrandAssets::publish('hero-sekolah.jpg', 'hero-sekolah.jpg'),
            'button_text' => 'Daftar PPDB',
            'button_url' => '/ppdb',
            'order' => 1,
            'is_active' => true,
        ]);
    }
}
