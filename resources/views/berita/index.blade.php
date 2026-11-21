@extends('layouts.app')

@section('title', 'Berita & Informasi')

@section('content')
    <x-page-header title="Berita & Informasi" eyebrow="Kabar Pesantren" :crumbs="['Berita']"
        intro="Pengumuman resmi, liputan kegiatan, dan capaian terbaru." />

    <section class="section">
        <div class="container-shell">
            <div class="mb-10 flex flex-wrap gap-2" aria-label="Filter kategori">
                <a href="{{ route('berita.index') }}" @class(['rounded-full px-4 py-2 text-sm font-semibold transition', 'bg-espresso text-cream' => ! $activeCategory, 'bg-beige text-espresso hover:bg-sand/40' => $activeCategory])>Semua</a>
                @foreach ($categories as $c)
                    <a href="{{ route('berita.index', ['kategori' => $c->slug]) }}" @class(['rounded-full px-4 py-2 text-sm font-semibold transition', 'bg-espresso text-cream' => $activeCategory === $c->slug, 'bg-beige text-espresso hover:bg-sand/40' => $activeCategory !== $c->slug])>{{ $c->name }}</a>
                @endforeach
            </div>

            @if ($posts->isEmpty())
                <x-empty-state message="Belum ada berita." />
            @else
                <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $post)<x-post-card :post="$post" />@endforeach
                </div>
                {{ $posts->links() }}
            @endif
        </div>
    </section>
@endsection
