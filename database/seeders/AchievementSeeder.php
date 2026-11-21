<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        Achievement::query()->delete();

        $y = (int) now()->format('Y');
        $rows = [
            ['Musabaqah Hifzil Qur\'an 10 Juz', 'Muhammad Rizky', 'Juara 1', 'Provinsi', $y],
            ['Olimpiade Sains Madrasah (Matematika)', 'Aisyah Putri', 'Medali Perak', 'Nasional', $y],
            ['Lomba Pidato Bahasa Arab', 'Farhan Nugraha', 'Juara 2', 'Kabupaten/Kota', $y],
            ['Kejuaraan Pencak Silat Pelajar', 'Tim Pencak Silat', 'Juara 3', 'Provinsi', $y - 1],
            ['Kompetisi Karya Tulis Ilmiah Remaja', 'Nadia & Salsabila', 'Juara 1', 'Kabupaten/Kota', $y - 1],
            ['Festival Hadrah Antar-Pesantren', 'Grup Hadrah MA Tarbiyatut Tholibin', 'Juara Umum', 'Provinsi', $y - 1],
        ];

        foreach ($rows as [$title, $student, $rank, $level, $year]) {
            Achievement::create([
                'title' => $title, 'student_name' => $student, 'rank' => $rank,
                'level' => $level, 'year' => $year, 'is_active' => true,
            ]);
        }
    }
}
