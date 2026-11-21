<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Database\Seeders\Support\BrandAssets;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->delete();

        SiteSetting::create([
            'site_name' => 'Madrasah Aliyah Tarbiyatut Tholibin',
            'tagline' => 'Berilmu, Berakhlak, Berprestasi',
            'logo' => BrandAssets::publish('logo.png', 'logo.png'),
            'favicon' => BrandAssets::publish('favicon.png', 'favicon.png'),
            'about_summary' => 'Madrasah Aliyah Tarbiyatut Tholibin berada di Batumirah, Bumijawa, Kabupaten Tegal. Kami memadukan pendidikan agama dan umum untuk membentuk peserta didik yang berilmu, berakhlak mulia, dan siap berkontribusi bagi masyarakat.',
            'meta_description' => 'Website resmi Madrasah Aliyah Tarbiyatut Tholibin, Batumirah, Bumijawa, Kab. Tegal — profil, akademik, kesiswaan, galeri, alumni, dan informasi PPDB.',
            // Isi kontak & media sosial melalui Admin → Pengaturan Website.
            'address' => "Desa Batumirah, Kec. Bumijawa\nKabupaten Tegal, Jawa Tengah",
            'map_embed_url' => 'https://www.google.com/maps?q=Batumirah,+Bumijawa,+Tegal&output=embed',
            'ppdb_is_open' => true,
            'ppdb_headline' => 'PPDB Tahun Ajaran 2027/2028 Telah Dibuka',
            'ppdb_description' => 'Pendaftaran peserta didik baru telah dibuka. Informasi persyaratan dan alur pendaftaran dapat dilihat pada halaman PPDB.',
            'ppdb_deadline' => now()->addMonths(4)->toDateString(),
        ]);
    }
}
