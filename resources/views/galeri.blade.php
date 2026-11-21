@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
    <x-page-header title="Galeri Kegiatan" eyebrow="Dokumentasi" :crumbs="['Galeri']"
        intro="Potret keseharian dan momen istimewa di lingkungan pesantren." />

    <section class="section" x-data="{ cat: 'semua', light: null, photos: @js($photos->map(fn ($p) => ['src' => asset('storage/'.$p->image), 'title' => $p->title, 'cat' => $p->category])->values()) }"
             @keydown.escape.window="light = null"
             @keydown.arrow-right.window="light !== null && (light = (light + 1) % photos.length)"
             @keydown.arrow-left.window="light !== null && (light = (light - 1 + photos.length) % photos.length)">
        <div class="container-shell">
            @if ($photos->isEmpty())
                <x-empty-state message="Belum ada foto." />
            @else
                <div class="mb-10 flex flex-wrap gap-2" role="tablist" aria-label="Filter kategori galeri">
                    <button type="button" role="tab" @click="cat = 'semua'" :aria-selected="cat === 'semua'"
                            :class="cat === 'semua' ? 'bg-espresso text-cream' : 'bg-beige text-espresso hover:bg-sand/40'"
                            class="rounded-full px-4 py-2 text-sm font-semibold transition">Semua</button>
                    @foreach ($categories as $c)
                        <button type="button" role="tab" @click="cat = '{{ $c }}'" :aria-selected="cat === '{{ $c }}'"
                                :class="cat === '{{ $c }}' ? 'bg-espresso text-cream' : 'bg-beige text-espresso hover:bg-sand/40'"
                                class="rounded-full px-4 py-2 text-sm font-semibold capitalize transition">{{ $c }}</button>
                    @endforeach
                </div>

                <div class="columns-2 gap-4 space-y-4 md:columns-3 lg:columns-4">
                    @foreach ($photos as $n => $photo)
                        <button type="button" x-show="cat === 'semua' || cat === '{{ $photo->category }}'" x-transition.opacity
                                @click="light = {{ $n }}"
                                class="group relative block w-full break-inside-avoid overflow-hidden rounded-2xl bg-beige text-left shadow-card">
                            <img src="{{ asset('storage/'.$photo->image) }}" alt="{{ $photo->title }}" loading="lazy" class="w-full transition duration-700 ease-out-expo group-hover:scale-105">
                            <span class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-espresso-900/85 to-transparent p-4 pt-10 text-sm font-medium text-cream opacity-0 transition group-hover:opacity-100 group-focus-visible:opacity-100">{{ $photo->title }}</span>
                        </button>
                    @endforeach
                </div>

                {{-- Lightbox --}}
                <div x-cloak x-show="light !== null" x-transition.opacity role="dialog" aria-modal="true" aria-label="Pratinjau foto"
                     class="fixed inset-0 z-[90] grid place-items-center bg-espresso-900/95 p-4" @click.self="light = null">
                    <button type="button" @click="light = null" class="absolute right-4 top-4 grid h-11 w-11 place-items-center rounded-full bg-cream/10 text-cream hover:bg-cream/20" aria-label="Tutup"><x-heroicon-o-x-mark class="h-6 w-6" /></button>
                    <button type="button" @click="light = (light - 1 + photos.length) % photos.length" class="absolute left-3 grid h-11 w-11 place-items-center rounded-full bg-cream/10 text-cream hover:bg-cream/20" aria-label="Sebelumnya"><x-heroicon-o-arrow-left class="h-5 w-5" /></button>
                    <button type="button" @click="light = (light + 1) % photos.length" class="absolute right-3 grid h-11 w-11 place-items-center rounded-full bg-cream/10 text-cream hover:bg-cream/20" aria-label="Berikutnya"><x-heroicon-o-arrow-right class="h-5 w-5" /></button>
                    <figure class="max-h-full max-w-5xl" x-show="light !== null">
                        <img :src="photos[light]?.src" :alt="photos[light]?.title" class="max-h-[80vh] rounded-xl object-contain">
                        <figcaption class="mt-3 text-center text-sm text-cream/85" x-text="photos[light]?.title"></figcaption>
                    </figure>
                </div>
            @endif
        </div>
    </section>
@endsection
