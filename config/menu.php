<?php

/**
 * Frontend navbar structure. `route` values are named routes (routes/web.php).
 * `match` is a routeIs() pattern used to highlight the active parent item.
 */
return [
    ['label' => 'Beranda', 'route' => 'home', 'match' => 'home'],
    [
        'label' => 'Profil', 'match' => 'profil.*', 'children' => [
            ['label' => 'Sejarah & Sambutan Kepala Madrasah', 'route' => 'profil.sejarah'],
            ['label' => 'Visi, Misi & Tujuan', 'route' => 'profil.visi-misi'],
            ['label' => 'Struktur Organisasi', 'route' => 'profil.struktur'],
        ],
    ],
    [
        'label' => 'Akademik', 'match' => 'akademik.*', 'children' => [
            ['label' => 'Jadwal Kegiatan Tahunan', 'route' => 'akademik.jadwal'],
            ['label' => 'Kalender Akademik', 'route' => 'akademik.kalender'],
            ['label' => 'Kurikulum & Program Unggulan', 'route' => 'akademik.kurikulum'],
        ],
    ],
    [
        'label' => 'Kesiswaan', 'match' => 'kesiswaan.*', 'children' => [
            ['label' => 'Daftar Ekstrakurikuler', 'route' => 'kesiswaan.ekskul'],
            ['label' => 'Prestasi Siswa', 'route' => 'kesiswaan.prestasi'],
            ['label' => 'Tata Tertib & Layanan Siswa', 'route' => 'kesiswaan.tata-tertib'],
        ],
    ],
    ['label' => 'Galeri', 'route' => 'galeri', 'match' => 'galeri'],
    ['label' => 'Alumni', 'route' => 'alumni', 'match' => 'alumni'],
    ['label' => 'Kontak', 'route' => 'kontak', 'match' => 'kontak'],
];
