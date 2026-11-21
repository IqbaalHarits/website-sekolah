<?php

namespace Database\Seeders;

use App\Models\FeaturedAlumnus;
use Illuminate\Database\Seeder;

class FeaturedAlumnusSeeder extends Seeder
{
    public function run(): void
    {
        FeaturedAlumnus::query()->delete();

        $y = (int) now()->format('Y');
        $rows = [
            ['dr. Hanifah Rahmawati', $y - 9, 'Dokter Umum, RSUP Dr. Sardjito', 'Disiplin dan budaya belajar di madrasah membentuk ketahanan saya melewati pendidikan kedokteran.', 'Lulus dengan predikat cumlaude dari FK UGM dan kini aktif dalam layanan kesehatan masyarakat di daerah terpencil.'],
            ['Ahmad Syarif, M.Sc.', $y - 12, 'Peneliti, Universiti Malaya', 'Tradisi menulis dan berdiskusi di pesantren menumbuhkan kecintaan saya pada riset.', 'Meraih beasiswa penuh S2 di Malaysia dan menerbitkan beberapa jurnal internasional di bidang energi terbarukan.'],
            ['Nadia Kusuma', $y - 6, 'Founder, Kreasi Muslimah Studio', 'Di sini saya belajar bahwa kepemimpinan bermula dari melayani.', 'Membangun usaha busana muslim yang kini memberdayakan puluhan penjahit lokal.'],
            ['Muhammad Iqbal, Lc.', $y - 10, 'Dai & Pengajar Ma\'had Aly', 'Bekal bahasa Arab dari pesantren membuat studi di Al-Azhar terasa lebih mudah.', 'Lulusan Universitas Al-Azhar Kairo yang kini mengajar dan mengasuh kajian di berbagai kota.'],
        ];

        foreach ($rows as $i => [$name, $year, $pos, $testi, $story]) {
            FeaturedAlumnus::create([
                'name' => $name, 'graduation_year' => $year, 'current_position' => $pos,
                'testimonial' => $testi, 'success_story' => $story, 'order' => $i, 'is_featured' => true,
            ]);
        }
    }
}
