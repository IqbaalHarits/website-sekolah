@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan (404)')

@section('content')
    <section class="section">
        <div class="container-shell">
            <div class="mx-auto max-w-xl rounded-card border border-sand/40 bg-beige p-10 text-center shadow-card sm:p-14">
                <p class="font-display text-6xl font-semibold text-sand">404</p>
                <h1 class="mt-4 font-display text-2xl font-semibold text-espresso sm:text-3xl">Halaman Tidak Ditemukan</h1>
                <p class="mt-3 text-sm leading-relaxed text-ink/75">
                    Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('home') }}" class="btn-primary">Kembali ke Beranda</a>
                    <a href="{{ route('kontak') }}" class="btn-outline">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </section>
@endsection
