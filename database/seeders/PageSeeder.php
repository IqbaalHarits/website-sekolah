<?php

namespace Database\Seeders;

use App\Models\Page;
use Database\Seeders\Support\PlaceholderImage;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::query()->delete();

        $pages = [
            [
                'slug' => 'sejarah', 'title' => 'Sejarah Pesantren', 'group' => 'profil', 'order' => 1,
                'excerpt' => 'Perjalanan lebih dari dua dekade membangun generasi berilmu dan berakhlak.',
                'content' => '<p>Madrasah Aliyah Tarbiyatut Tholibin berlokasi di Desa Batumirah, Kecamatan Bumijawa, Kabupaten Tegal, Jawa Tengah. Madrasah hadir untuk menjawab kebutuhan masyarakat akan pendidikan menengah yang memadukan ilmu agama dan ilmu umum secara seimbang.</p><h2>Awal Berdiri</h2><p><em>(Contoh teks — silakan ganti dengan sejarah berdirinya madrasah melalui menu Admin → Halaman Profil.)</em></p><h2>Perkembangan</h2><p>Dari waktu ke waktu madrasah terus berbenah, menambah sarana dan prasarana, serta meningkatkan mutu pembelajaran untuk melahirkan lulusan yang berilmu dan berakhlak mulia.</p><blockquote>Ilmu tanpa akhlak ibarat pohon tanpa buah.</blockquote>',
            ],
            [
                'slug' => 'sambutan', 'title' => 'Sambutan Kepala Madrasah', 'group' => 'profil', 'order' => 2,
                'author_name' => 'Nama Kepala Madrasah', 'author_position' => 'Kepala Madrasah Aliyah Tarbiyatut Tholibin',
                'excerpt' => 'Assalamu\'alaikum warahmatullahi wabarakatuh.',
                'content' => '<p>Alhamdulillah, segala puji bagi Allah SWT yang telah menganugerahkan nikmat dan hidayah-Nya kepada kita semua. Selamat datang di website resmi Madrasah Aliyah Tarbiyatut Tholibin.</p><p>Kami meyakini bahwa pendidikan sejati tidak hanya mencerdaskan akal, tetapi juga menumbuhkan hati. Karena itu, seluruh program kami dirancang untuk membentuk santri yang kokoh akidahnya, luas wawasannya, dan mulia akhlaknya.</p><p>Kami mengajak seluruh orang tua, alumni, dan masyarakat untuk bersinergi mendampingi ananda dalam perjalanan menuntut ilmu. Semoga Allah SWT meridai ikhtiar kita bersama.</p><p>Wassalamu\'alaikum warahmatullahi wabarakatuh.</p>',
            ],
            [
                'slug' => 'visi-misi', 'title' => 'Visi, Misi & Tujuan', 'group' => 'profil', 'order' => 3,
                'excerpt' => 'Arah dan komitmen kami dalam membangun generasi rabbani.',
                'content' => '<h2>Visi</h2><p>Menjadi pusat pendidikan Islam terpadu yang melahirkan generasi berilmu, berakhlak mulia, mandiri, dan berdaya saing global.</p><h2>Misi</h2><ul><li>Menyelenggarakan pendidikan yang memadukan kurikulum nasional dan kurikulum pesantren.</li><li>Menanamkan nilai-nilai akidah, ibadah, dan akhlak karimah dalam keseharian santri.</li><li>Mengembangkan potensi akademik, bahasa, seni, dan kepemimpinan melalui program unggulan dan ekstrakurikuler.</li><li>Membangun budaya disiplin, kemandirian, dan kepedulian sosial.</li><li>Menjalin kemitraan dengan keluarga, masyarakat, dan lembaga pendidikan.</li></ul><h2>Tujuan</h2><ol><li>Terwujudnya lulusan yang hafal minimal 5 juz Al-Qur\'an.</li><li>Terwujudnya lulusan yang mampu berkomunikasi aktif dalam bahasa Arab dan Inggris.</li><li>Meningkatnya prestasi akademik dan non-akademik di tingkat nasional.</li><li>Terserapnya lulusan di perguruan tinggi unggulan dalam dan luar negeri.</li></ol>',
            ],
            [
                'slug' => 'struktur-organisasi', 'title' => 'Struktur Organisasi', 'group' => 'profil', 'order' => 4,
                'excerpt' => 'Susunan pengurus dan tenaga kependidikan.',
                'content' => '<h2>Pimpinan</h2><ul><li><strong>Kepala Madrasah</strong> — (nama)</li><li><strong>Waka Bidang Kurikulum</strong> — (nama)</li><li><strong>Waka Bidang Kesiswaan</strong> — (nama)</li><li><strong>Waka Bidang Sarana & Humas</strong> — (nama)</li></ul><h2>Tenaga Kependidikan</h2><ul><li><strong>Kepala Tata Usaha</strong> — (nama)</li><li><strong>Koordinator Tahfidz</strong> — (nama)</li></ul><p><em>(Contoh struktur — silakan sesuaikan melalui Admin → Halaman Profil.)</em></p>',
            ],
            [
                'slug' => 'kurikulum', 'title' => 'Kurikulum', 'group' => 'akademik', 'order' => 1,
                'excerpt' => 'Perpaduan Kurikulum Merdeka, Kementerian Agama, dan kurikulum khas pesantren.',
                'content' => '<p>Kurikulum Madrasah Aliyah Tarbiyatut Tholibin disusun dengan tiga pilar yang saling menguatkan:</p><ol><li><strong>Kurikulum Nasional</strong> — Kurikulum Merdeka dan standar Kementerian Agama untuk mata pelajaran umum dan keagamaan.</li><li><strong>Kurikulum Pesantren</strong> — kajian kitab kuning, fikih, hadis, tafsir, nahwu-sharaf, dan akhlak.</li><li><strong>Kurikulum Pengembangan Diri</strong> — kepemimpinan, kewirausahaan, teknologi, dan layanan masyarakat.</li></ol><p>Pembelajaran berlangsung pagi hingga siang untuk mata pelajaran formal, dilanjutkan kegiatan keagamaan sore dan malam hari di asrama.</p>',
            ],
            [
                'slug' => 'tata-tertib', 'title' => 'Tata Tertib & Layanan Siswa', 'group' => 'kesiswaan', 'order' => 1,
                'excerpt' => 'Aturan yang menjaga kenyamanan dan kedisiplinan seluruh santri.',
                'content' => '<h2>Tata Tertib Umum</h2><ul><li>Santri wajib mengikuti salat berjamaah lima waktu dan kegiatan pesantren.</li><li>Berpakaian rapi dan sopan sesuai ketentuan seragam harian.</li><li>Menggunakan bahasa Arab/Inggris pada hari bahasa yang ditentukan.</li><li>Dilarang membawa alat elektronik pribadi tanpa izin pengasuh.</li><li>Menjaga kebersihan kamar, kelas, dan lingkungan pesantren.</li><li>Izin keluar lingkungan pesantren melalui bagian keamanan.</li></ul><h2>Layanan Siswa</h2><ul><li><strong>Bimbingan & Konseling</strong> — Senin–Jumat, 08.00–15.00.</li><li><strong>Layanan Kesehatan (Poskestren)</strong> — tenaga kesehatan siaga setiap hari.</li><li><strong>Layanan Beasiswa</strong> — informasi dan pendaftaran di ruang Tata Usaha.</li><li><strong>Kunjungan Wali</strong> — Sabtu & Ahad, 09.00–16.00.</li></ul>',
            ],
            [
                'slug' => 'ppdb', 'title' => 'Informasi PPDB', 'group' => 'ppdb', 'order' => 1,
                'excerpt' => 'Persyaratan dan alur pendaftaran santri baru.',
                'content' => '<h2>Persyaratan</h2><ul><li>Fotokopi akta kelahiran dan kartu keluarga.</li><li>Fotokopi ijazah / surat keterangan lulus terakhir.</li><li>Pas foto 3×4 sebanyak 4 lembar.</li><li>Surat keterangan sehat dari dokter / puskesmas.</li><li>Mengisi formulir pendaftaran dan surat pernyataan wali.</li></ul><h2>Alur Pendaftaran</h2><ol><li>Mengisi formulir pendaftaran daring atau datang langsung ke sekretariat.</li><li>Verifikasi berkas oleh panitia.</li><li>Mengikuti tes tulis, tes baca Al-Qur\'an, dan wawancara.</li><li>Pengumuman hasil seleksi.</li><li>Daftar ulang dan pembayaran administrasi.</li></ol><h2>Biaya & Beasiswa</h2><p>Rincian biaya dijelaskan oleh panitia. Tersedia beasiswa prestasi akademik, tahfidz, dan keringanan bagi santri yatim/dhuafa.</p>',
            ],
        ];

        foreach ($pages as $i => $data) {
            if ($data['slug'] === 'sejarah' || $data['slug'] === 'sambutan') {
                $data['image'] = PlaceholderImage::make('seed/pages', $data['slug'], 1000, 1200, $data['slug'] === 'sejarah' ? 2 : 0);
            }
            Page::create($data + ['is_published' => true]);
        }
    }
}
