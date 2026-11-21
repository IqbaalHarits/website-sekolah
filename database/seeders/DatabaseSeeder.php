<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SiteSettingSeeder::class,
            SliderSeeder::class,
            PageSeeder::class,
            PostSeeder::class,
            AcademicScheduleSeeder::class,
            ProgramSeeder::class,
            AchievementSeeder::class,
            GallerySeeder::class,
            FeaturedAlumnusSeeder::class,
        ]);
    }
}
