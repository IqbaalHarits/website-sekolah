<?php

namespace Database\Seeders;

use App\Models\AcademicSchedule;
use Illuminate\Database\Seeder;

class AcademicScheduleSeeder extends Seeder
{
    public function run(): void
    {
        AcademicSchedule::query()->delete();

        $y = (int) now()->format('Y');
        $rows = [
            // Kalender akademik
            ['Awal Tahun Ajaran Baru', 'kalender_akademik', "$y-07-13", "$y-07-13", 'Hari pertama masuk tahun ajaran baru.'],
            ['Masa Pengenalan Lingkungan Pesantren (MPLP)', 'kalender_akademik', "$y-07-13", "$y-07-18", 'Orientasi santri baru.'],
            ['Ujian Tengah Semester Ganjil', 'kalender_akademik', "$y-09-21", "$y-09-26", null],
            ['Ujian Akhir Semester Ganjil', 'kalender_akademik', "$y-12-07", "$y-12-18", null],
            ['Libur Semester Ganjil', 'kalender_akademik', "$y-12-21", ($y + 1)."-01-02", 'Santri pulang ke rumah masing-masing.'],
            ['Awal Semester Genap', 'kalender_akademik', ($y + 1)."-01-05", ($y + 1)."-01-05", null],
            ['Ujian Akhir Semester Genap', 'kalender_akademik', ($y + 1)."-06-01", ($y + 1)."-06-12", null],
            ['Pembagian Rapor & Libur Kenaikan Kelas', 'kalender_akademik', ($y + 1)."-06-20", ($y + 1)."-07-10", null],
            // Kegiatan tahunan
            ['Peringatan Maulid Nabi Muhammad SAW', 'tahunan', "$y-09-05", "$y-09-05", 'Pengajian akbar dan lomba-lomba islami.'],
            ['Pekan Olahraga & Seni Pesantren (POSPEN)', 'tahunan', "$y-10-12", "$y-10-17", 'Kompetisi antar-asrama.'],
            ['Peringatan Hari Santri Nasional', 'tahunan', "$y-10-22", "$y-10-22", 'Upacara dan kirab santri.'],
            ['Wisuda Tahfidz', 'tahunan', "$y-11-28", "$y-11-28", 'Penyerahan sertifikat hafalan.'],
            ['Pesantren Kilat Ramadan', 'tahunan', ($y + 1)."-02-16", ($y + 1)."-02-26", null],
            ['Haflah Akhirussanah & Wisuda Kelulusan', 'tahunan', ($y + 1)."-06-27", ($y + 1)."-06-27", 'Puncak kegiatan akhir tahun ajaran.'],
        ];

        foreach ($rows as [$title, $cat, $start, $end, $desc]) {
            AcademicSchedule::create([
                'title' => $title, 'category' => $cat, 'start_date' => $start,
                'end_date' => $end === $start ? null : $end, 'description' => $desc, 'is_active' => true,
            ]);
        }
    }
}
