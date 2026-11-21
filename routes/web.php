<?php

use App\Http\Controllers\AcademicController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('sejarah-sambutan', [PageController::class, 'sejarah'])->name('sejarah');
    Route::get('visi-misi', [PageController::class, 'show'])->defaults('slug', 'visi-misi')->name('visi-misi');
    Route::get('struktur-organisasi', [PageController::class, 'show'])->defaults('slug', 'struktur-organisasi')->name('struktur');
});

Route::prefix('akademik')->name('akademik.')->group(function () {
    Route::get('jadwal-kegiatan-tahunan', [AcademicController::class, 'jadwal'])->name('jadwal');
    Route::get('kalender-akademik', [AcademicController::class, 'kalender'])->name('kalender');
    Route::get('kurikulum-program-unggulan', [AcademicController::class, 'kurikulum'])->name('kurikulum');
});

Route::prefix('kesiswaan')->name('kesiswaan.')->group(function () {
    Route::get('ekstrakurikuler', [StudentController::class, 'ekskul'])->name('ekskul');
    Route::get('prestasi-siswa', [StudentController::class, 'prestasi'])->name('prestasi');
    Route::get('tata-tertib', [PageController::class, 'show'])->defaults('slug', 'tata-tertib')->name('tata-tertib');
});

Route::get('berita', [PostController::class, 'index'])->name('berita.index');
Route::get('berita/{slug}', [PostController::class, 'show'])->name('berita.show');

Route::get('galeri', GalleryController::class)->name('galeri');
Route::get('alumni', AlumniController::class)->name('alumni');

Route::get('kontak', [ContactController::class, 'index'])->name('kontak');
Route::post('kontak', [ContactController::class, 'store'])->middleware('throttle:5,10')->name('kontak.store');

Route::get('ppdb', PpdbController::class)->name('ppdb');

Route::get('sitemap.xml', function () {
    $urls = collect([
        route('home'),
        route('profil.sejarah'),
        route('profil.visi-misi'),
        route('profil.struktur'),
        route('akademik.jadwal'),
        route('akademik.kalender'),
        route('akademik.kurikulum'),
        route('kesiswaan.ekskul'),
        route('kesiswaan.prestasi'),
        route('kesiswaan.tata-tertib'),
        route('berita.index'),
        route('galeri'),
        route('alumni'),
        route('kontak'),
        route('ppdb'),
    ])->merge(
        \App\Models\Post::published()->pluck('slug')->map(fn ($s) => route('berita.show', $s))
    );

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
        .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n"
        .$urls->map(fn ($u) => '  <url><loc>'.e($u).'</loc></url>')->implode("\n")
        ."\n</urlset>";

    return response($xml, 200, ['Content-Type' => 'application/xml']);
})->name('sitemap');
