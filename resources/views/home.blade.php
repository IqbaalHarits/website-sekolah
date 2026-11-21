@extends('layouts.app')

@section('content')

{{-- ============ HERO ============ --}}
<section class="relative isolate overflow-hidden bg-espresso text-cream"
         x-data="{
            i: 0, total: {{ max($sliders->count(), 1) }}, paused: false, timer: null,
            go(n) { this.i = (n + this.total) % this.total },
            start() { if (this.total > 1 && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) this.timer = setInterval(() => { if (!this.paused) this.go(this.i + 1) }, 6500) }
         }"
         x-init="start()" @mouseenter="paused = true" @mouseleave="paused = false"
         aria-roledescription="carousel" aria-label="Sorotan sekolah">

    <div class="relative min-h-[34rem] sm:min-h-[40rem] lg:min-h-[44rem]">
        @forelse ($sliders as $n => $slide)
            <div class="absolute inset-0 transition-opacity duration-1000 ease-out"
                 x-show="i === {{ $n }}" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-700" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @if($n > 0) x-cloak @endif role="group" aria-roledescription="slide" aria-label="{{ $n + 1 }} dari {{ $sliders->count() }}">
                <x-photo :src="$slide->image" :alt="$slide->title" class="absolute inset-0" />
                <div class="absolute inset-0 bg-gradient-to-r from-espresso-900/90 via-espresso/65 to-espresso/20"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-espresso-900/70 via-transparent to-transparent"></div>

                <div class="container-shell relative flex h-full min-h-[34rem] items-center pb-28 pt-16 sm:min-h-[40rem] lg:min-h-[44rem]">
                    <div class="max-w-2xl" x-show="i === {{ $n }}" x-transition:enter="transition duration-700 delay-200 ease-out-expo"
                         x-transition:enter-start="translate-y-6 opacity-0" x-transition:enter-end="translate-y-0 opacity-100">
                        <p class="eyebrow !text-sand before:!bg-sand">{{ $site->site_name }}</p>
                        <h1 class="mt-5 font-display text-display-lg font-semibold !text-cream">{{ $slide->title }}</h1>
                        @if ($slide->subtitle)
                            <p class="mt-6 max-w-xl text-lg leading-relaxed text-cream/85">{{ $slide->subtitle }}</p>
                        @endif
                        <div class="mt-9 flex flex-wrap items-center gap-3">
                            @if ($slide->button_text && $slide->button_url)
                                <a href="{{ url($slide->button_url) }}" class="btn bg-sand text-ink hover:bg-sand-300">
                                    {{ $slide->button_text }} <x-heroicon-o-arrow-right class="h-4 w-4" />
                                </a>
                            @endif
                            <a href="{{ route('profil.sejarah') }}" class="btn border border-cream/40 text-cream hover:bg-cream hover:text-espresso">Tentang Kami</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="container-shell flex min-h-[34rem] items-center">
                <div class="max-w-2xl">
                    <h1 class="font-display text-display-lg font-semibold !text-cream">{{ $site->site_name }}</h1>
                    <p class="mt-5 text-lg text-cream/85">{{ $site->tagline }}</p>
                </div>
            </div>
        @endforelse
    </div>

    @if ($sliders->count() > 1)
        <div class="container-shell absolute inset-x-0 bottom-24 z-10 flex items-center justify-between sm:bottom-28">
            <div class="flex items-center gap-2" role="tablist" aria-label="Pilih slide">
                @foreach ($sliders as $n => $slide)
                    <button type="button" role="tab" @click="go({{ $n }})" :aria-selected="i === {{ $n }}"
                            aria-label="Slide {{ $n + 1 }}"
                            class="h-1.5 rounded-full bg-cream/40 transition-all duration-500"
                            :class="i === {{ $n }} ? 'w-10 !bg-sand' : 'w-4 hover:bg-cream/70'"></button>
                @endforeach
            </div>
            <div class="flex gap-2">
                <button type="button" @click="go(i - 1)" aria-label="Sebelumnya" class="grid h-11 w-11 place-items-center rounded-full border border-cream/30 text-cream transition hover:bg-cream hover:text-espresso"><x-heroicon-o-arrow-left class="h-5 w-5" /></button>
                <button type="button" @click="go(i + 1)" aria-label="Berikutnya" class="grid h-11 w-11 place-items-center rounded-full border border-cream/30 text-cream transition hover:bg-cream hover:text-espresso"><x-heroicon-o-arrow-right class="h-5 w-5" /></button>
            </div>
        </div>
    @endif
</section>

{{-- ============ QUICK INFO ============ --}}
<section class="container-shell relative z-10 -mt-16" aria-label="Informasi cepat">
    <div class="grid gap-4 lg:grid-cols-12">
        {{-- PPDB --}}
        <div class="rounded-card bg-sand p-7 shadow-card-hover lg:col-span-5">
            <div class="flex items-center gap-2">
                <span class="badge">PPDB</span>
                <span class="text-xs font-semibold {{ $site->ppdb_is_open ? 'text-espresso' : 'text-ink/60' }}">
                    {{ $site->ppdb_is_open ? 'Pendaftaran dibuka' : 'Pendaftaran ditutup' }}
                </span>
            </div>
            <h2 class="mt-4 font-display text-2xl font-semibold leading-tight !text-ink">{{ $site->ppdb_headline ?: 'Penerimaan Santri Baru' }}</h2>
            @if ($site->ppdb_deadline)
                <p class="mt-2 text-sm text-ink/80">Batas pendaftaran: <strong>{{ $site->ppdb_deadline->translatedFormat('d F Y') }}</strong></p>
            @endif
            <a href="{{ route('ppdb') }}" class="btn-primary mt-6">Info &amp; Pendaftaran <x-heroicon-o-arrow-right class="h-4 w-4" /></a>
        </div>

        {{-- Agenda --}}
        <div class="card p-7 lg:col-span-4">
            <p class="eyebrow">Agenda Terdekat</p>
            @if ($agenda->isNotEmpty())
                @php($next = $agenda->first())
                <p class="mt-4 font-display text-xl font-semibold leading-snug">{{ $next->title }}</p>
                <p class="mt-2 flex items-center gap-2 text-sm text-ink/70">
                    <x-heroicon-o-calendar-days class="h-4 w-4 text-espresso" />
                    {{ $next->start_date->translatedFormat('d F Y') }}
                </p>
            @else
                <p class="mt-4 text-sm text-ink/60">Belum ada agenda mendatang.</p>
            @endif
            <a href="{{ route('akademik.kalender') }}" class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-espresso hover:underline">Kalender akademik <x-heroicon-o-arrow-up-right class="h-4 w-4" /></a>
        </div>

        {{-- Kontak --}}
        <div class="card p-7 lg:col-span-3">
            <p class="eyebrow">Hubungi</p>
            <p class="mt-4 text-sm leading-relaxed text-ink/75">Ada pertanyaan seputar pendaftaran atau program? Kami siap membantu.</p>
            <a href="{{ route('kontak') }}" class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-espresso hover:underline">Kirim pesan <x-heroicon-o-arrow-up-right class="h-4 w-4" /></a>
        </div>
    </div>
</section>

{{-- ============ PROFIL RINGKAS ============ --}}
<section class="section">
    <div class="container-shell grid items-center gap-14 lg:grid-cols-12">
        <div class="relative lg:col-span-5">
            <div class="absolute -bottom-5 -left-5 h-full w-full rounded-card bg-sand/40" aria-hidden="true"></div>
            <div class="relative aspect-[4/5] overflow-hidden rounded-card shadow-card">
                <x-photo :src="$sambutan?->image" :alt="$sambutan?->author_name ?? $site->site_name" />
            </div>
        </div>
        <div class="lg:col-span-7">
            <x-section-heading eyebrow="Profil Singkat" :title="'Mengenal '.$site->site_name" />
            @if ($site->about_summary)
                <p class="mt-5 max-w-prose text-lg leading-relaxed text-ink/80">{{ $site->about_summary }}</p>
            @endif

            @if ($sambutan)
                <figure class="mt-8 border-l-2 border-sand pl-6">
                    <blockquote class="font-display text-xl leading-relaxed text-espresso">
                        “{{ \Illuminate\Support\Str::limit(strip_tags($sambutan->content), 190) }}”
                    </blockquote>
                    <figcaption class="mt-4 text-sm">
                        <span class="font-semibold text-ink">{{ $sambutan->author_name }}</span>
                        <span class="text-ink/60"> — {{ $sambutan->author_position }}</span>
                    </figcaption>
                </figure>
            @endif

            <div class="mt-9 flex flex-wrap gap-3">
                <a href="{{ route('profil.sejarah') }}" class="btn-primary">Sejarah &amp; Sambutan</a>
                <a href="{{ route('profil.visi-misi') }}" class="btn-outline">Visi &amp; Misi</a>
            </div>
        </div>
    </div>
</section>

{{-- ============ PROGRAM UNGGULAN ============ --}}
@if ($programs->isNotEmpty())
<section class="bg-beige section">
    <div class="container-shell grid gap-12 lg:grid-cols-12">
        <div class="lg:col-span-4">
            <div class="lg:sticky lg:top-28">
                <x-section-heading eyebrow="Program Unggulan" title="Ruang tumbuh bagi ilmu dan akhlak"
                    intro="Empat program inti yang menjadi ciri khas pendidikan di pesantren kami." />
                <a href="{{ route('akademik.kurikulum') }}" class="btn-outline mt-8">Lihat kurikulum</a>
            </div>
        </div>
        <ol class="lg:col-span-8">
            @foreach ($programs as $n => $program)
                <li class="group grid grid-cols-[auto_1fr] gap-x-6 gap-y-1 border-t border-espresso/15 py-8 first:border-t-0 first:pt-0 sm:grid-cols-[auto_1fr_9rem]">
                    <span class="font-display text-4xl font-semibold leading-none text-sand transition group-hover:text-espresso">{{ str_pad($n + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <div>
                        <h3 class="font-display text-2xl font-semibold">{{ $program->title }}</h3>
                        <p class="mt-2 max-w-xl leading-relaxed text-ink/75">{{ $program->description }}</p>
                    </div>
                    <div class="col-span-2 mt-4 aspect-[3/2] overflow-hidden rounded-xl sm:col-span-1 sm:mt-0 sm:aspect-square">
                        <x-photo :src="$program->image" :alt="$program->title" class="transition duration-700 ease-out-expo group-hover:scale-110" />
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</section>
@endif

{{-- ============ BERITA ============ --}}
@if ($posts->isNotEmpty())
<section class="section">
    <div class="container-shell">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <x-section-heading eyebrow="Berita & Informasi" title="Kabar terbaru dari pesantren" />
            <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-espresso hover:underline">Semua berita <x-heroicon-o-arrow-right class="h-4 w-4" /></a>
        </div>

        <div class="mt-12 grid gap-8 lg:grid-cols-12">
            @php($lead = $posts->first())
            <article class="group lg:col-span-7">
                <a href="{{ route('berita.show', $lead->slug) }}" class="block aspect-[16/10] overflow-hidden rounded-card bg-beige shadow-card">
                    <x-photo :src="$lead->featured_image" :alt="$lead->title" class="transition duration-700 ease-out-expo group-hover:scale-105" />
                </a>
                <div class="mt-6 flex items-center gap-3 text-xs text-ink/60">
                    @if ($lead->category)<span class="badge">{{ $lead->category->name }}</span>@endif
                    <time datetime="{{ $lead->published_at?->toDateString() }}">{{ $lead->published_at?->translatedFormat('d F Y') }}</time>
                </div>
                <h3 class="mt-3 font-display text-3xl font-semibold leading-tight">
                    <a href="{{ route('berita.show', $lead->slug) }}" class="decoration-sand decoration-2 underline-offset-4 hover:underline">{{ $lead->title }}</a>
                </h3>
                <p class="mt-3 max-w-xl leading-relaxed text-ink/70">{{ $lead->excerpt_text }}</p>
            </article>

            <div class="divide-y divide-sand/50 lg:col-span-5">
                @foreach ($posts->skip(1) as $post)
                    <article class="group flex gap-5 py-6 first:pt-0 last:pb-0">
                        <a href="{{ route('berita.show', $post->slug) }}" class="block aspect-square w-28 shrink-0 overflow-hidden rounded-xl bg-beige sm:w-32" tabindex="-1" aria-hidden="true">
                            <x-photo :src="$post->featured_image" :alt="$post->title" class="transition duration-700 ease-out-expo group-hover:scale-110" />
                        </a>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 text-xs text-ink/60">
                                @if ($post->category)<span class="font-semibold uppercase tracking-wider text-espresso">{{ $post->category->name }}</span><span aria-hidden="true">·</span>@endif
                                <time datetime="{{ $post->published_at?->toDateString() }}">{{ $post->published_at?->translatedFormat('d M Y') }}</time>
                            </div>
                            <h3 class="mt-2 font-display text-lg font-semibold leading-snug">
                                <a href="{{ route('berita.show', $post->slug) }}" class="hover:underline decoration-sand decoration-2 underline-offset-4">{{ $post->title }}</a>
                            </h3>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

{{-- ============ AGENDA + ALUMNI ============ --}}
@if ($alumni->isNotEmpty())
<section class="bg-beige section">
    <div class="container-shell">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <x-section-heading eyebrow="Alumni Pilihan" title="Jejak langkah para lulusan" />
            <a href="{{ route('alumni') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-espresso hover:underline">Semua alumni <x-heroicon-o-arrow-right class="h-4 w-4" /></a>
        </div>
        <div class="mt-12 grid gap-6 md:grid-cols-3">
            @foreach ($alumni as $a)
                <figure class="card flex flex-col p-7">
                    <blockquote class="flex-1 font-display text-lg leading-relaxed text-espresso">“{{ $a->testimonial }}”</blockquote>
                    <figcaption class="mt-6 flex items-center gap-4 border-t border-sand/40 pt-5">
                        <x-avatar :name="$a->name" :src="$a->photo" class="h-12 w-12 text-sm" />
                        <div class="min-w-0 text-sm">
                            <p class="font-semibold text-ink">{{ $a->name }}</p>
                            <p class="truncate text-ink/60">{{ $a->current_position }} · Lulusan {{ $a->graduation_year }}</p>
                        </div>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============ CTA PPDB ============ --}}
<section class="section">
    <div class="container-shell">
        <div class="relative isolate overflow-hidden rounded-[1.75rem] bg-espresso px-8 py-14 text-cream sm:px-14 sm:py-20">
            <svg aria-hidden="true" class="absolute -right-10 -top-10 -z-10 h-[28rem] w-[28rem] text-sand/15" viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width=".6">
                @foreach (range(1, 9) as $r)<circle cx="100" cy="100" r="{{ $r * 11 }}" />@endforeach
            </svg>
            <div class="max-w-2xl">
                <p class="eyebrow !text-sand before:!bg-sand">Penerimaan Santri Baru</p>
                <h2 class="mt-4 font-display text-display-md font-semibold !text-cream">{{ $site->ppdb_headline ?: 'Bergabunglah bersama kami' }}</h2>
                @if ($site->ppdb_description)
                    <p class="mt-5 text-lg leading-relaxed text-cream/80">{{ $site->ppdb_description }}</p>
                @endif
                <div class="mt-9 flex flex-wrap gap-3">
                    <a href="{{ route('ppdb') }}" class="btn bg-sand text-ink hover:bg-sand-300">Lihat Informasi PPDB <x-heroicon-o-arrow-right class="h-4 w-4" /></a>
                    <a href="{{ route('kontak') }}" class="btn border border-cream/40 text-cream hover:bg-cream hover:text-espresso">Tanya Panitia</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
