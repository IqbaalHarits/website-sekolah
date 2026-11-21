<?php

namespace Database\Seeders;

use App\Models\Program;
use Database\Seeders\Support\PlaceholderImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        Program::query()->delete();

        $rows = [
            ['Tahfidzul Qur\'an', 'program_unggulan', 'Target hafalan 5–30 juz dengan metode talaqqi, muraja\'ah harian, dan evaluasi berjenjang.', null],
            ['Bahasa Arab & Inggris', 'program_unggulan', 'Lingkungan berbahasa aktif, kelas percakapan, dan persiapan tes TOEFL serta Imtihan.', null],
            ['Kajian Kitab Turats', 'program_unggulan', 'Pendalaman fikih, hadis, tafsir, dan nahwu-sharaf melalui kajian kitab kuning.', null],
            ['Sains & Teknologi', 'program_unggulan', 'Laboratorium IPA, robotik dasar, dan pengenalan pemrograman untuk santri.', null],
            ['Pramuka', 'ekstrakurikuler', 'Melatih kepemimpinan, kemandirian, dan kepedulian sosial.', 'Setiap Jumat, 15.30'],
            ['Pencak Silat', 'ekstrakurikuler', 'Seni bela diri untuk kebugaran dan pengendalian diri.', 'Selasa & Kamis, 16.00'],
            ['Hadrah & Nasyid', 'ekstrakurikuler', 'Seni musik islami, rutin tampil pada acara pesantren.', 'Rabu, 16.00'],
            ['Jurnalistik & Multimedia', 'ekstrakurikuler', 'Menulis, fotografi, dan produksi video dokumentasi kegiatan.', 'Sabtu, 09.00'],
            ['Futsal & Panahan', 'ekstrakurikuler', 'Olahraga sunnah dan tim untuk menjaga kebugaran santri.', 'Senin & Kamis, 16.00'],
            ['Kaligrafi', 'ekstrakurikuler', 'Mempelajari khat naskhi, tsuluts, dan diwani.', 'Ahad, 08.00'],
        ];

        foreach ($rows as $i => [$title, $type, $desc, $schedule]) {
            Program::create([
                'title' => $title, 'slug' => Str::slug($title), 'type' => $type, 'description' => $desc,
                'schedule_info' => $schedule, 'order' => $i,
                'image' => PlaceholderImage::make('seed/programs', Str::slug($title), 900, 600, $i),
                'is_active' => true,
            ]);
        }
    }
}
