@extends('layouts.app')

@section('title', 'Terjadi Gangguan Sistem (500)')

@section('content')
    <section class="section">
        <div class="container-shell">
            <div class="mx-auto max-w-xl rounded-card border border-sand/40 bg-beige p-10 text-center shadow-card sm:p-14">
                <p class="font-display text-6xl font-semibold text-sand">500</p>
                <h1 class="mt-4 font-display text-2xl font-semibold text-espresso sm:text-3xl">Terjadi Gangguan pada Server</h1>
                <p class="mt-3 text-sm leading-relaxed text-ink/75">
                    Maaf, permintaan Anda belum dapat diproses saat ini. Silakan muat ulang halaman beberapa saat lagi.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('home') }}" class="btn-primary">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </section>
@endsection
