<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Database\Seeders\Support\PlaceholderImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::query()->delete();
        PostCategory::query()->delete();

        $cats = collect(['Berita', 'Pengumuman', 'Prestasi', 'Kegiatan'])
            ->mapWithKeys(fn ($n) => [$n => PostCategory::create(['name' => $n, 'slug' => Str::slug($n)])]);

        $author = User::first();

        $posts = [
            ['Pendaftaran Peserta Didik Baru Gelombang I Resmi Dibuka', 'Pengumuman', 'MA Tarbiyatut Tholibin membuka pendaftaran peserta didik baru tahun ajaran 2027/2028.'],
            ['Siswa MA Tarbiyatut Tholibin Juara 1 Musabaqah Hifzil Qur\'an Tingkat Provinsi', 'Prestasi', 'Ananda Muhammad Rizky meraih juara pertama cabang hifzil Qur\'an 10 juz pada MHQ tingkat provinsi.'],
            ['Pesantren Kilat Ramadan: Menumbuhkan Cinta Al-Qur\'an', 'Kegiatan', 'Ratusan santri dan pelajar sekitar mengikuti rangkaian pesantren kilat selama sepuluh hari.'],
            ['Kunjungan Studi Banding dari Pesantren Mitra Malaysia', 'Berita', 'Delegasi dari Kuala Lumpur berbagi pengalaman pengelolaan kurikulum tahfidz dan bahasa.'],
            ['Jadwal Ujian Tengah Semester Ganjil', 'Pengumuman', 'Ujian Tengah Semester akan dilaksanakan dua pekan ke depan. Santri diminta mempersiapkan diri.'],
            ['Wisuda Tahfidz Angkatan ke-12: 47 Santri Menyelesaikan Hafalan', 'Kegiatan', 'Wisuda tahfidz dihadiri wali santri, alumni, dan tokoh masyarakat dalam suasana penuh haru.'],
        ];

        foreach ($posts as $i => [$title, $cat, $excerpt]) {
            Post::create([
                'post_category_id' => $cats[$cat]->id,
                'author_id' => $author?->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'excerpt' => $excerpt,
                'featured_image' => PlaceholderImage::make('seed/posts', 'post-'.($i + 1), 1200, 800, $i),
                'content' => "<p>{$excerpt}</p><p>Kegiatan ini berlangsung dengan lancar berkat dukungan seluruh dewan guru, pengurus asrama, wali santri, dan masyarakat. Panitia mengucapkan terima kasih atas partisipasi semua pihak.</p><p>Informasi lebih lanjut dapat diperoleh melalui bagian Tata Usaha atau menghubungi kontak resmi pesantren yang tertera pada halaman Kontak.</p><h2>Catatan Penting</h2><ul><li>Pantau terus pengumuman resmi melalui website ini.</li><li>Hubungi panitia untuk pertanyaan lebih lanjut.</li></ul>",
                'is_published' => true,
                'published_at' => now()->subDays(($i + 1) * 6),
            ]);
        }
    }
}
