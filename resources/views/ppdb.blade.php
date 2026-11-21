@extends('layouts.app')

@section('title', 'PPDB')

@section('content')
    <x-page-header :title="$site->ppdb_headline ?: 'Penerimaan Peserta Didik Baru'" eyebrow="PPDB" :crumbs="['PPDB']" :intro="$site->ppdb_description" />

    <section class="section">
        <div class="container-shell grid gap-10 lg:grid-cols-12">
            <div class="lg:col-span-8">
                @if ($page)
                    <article class="prose prose-lg max-w-none">{!! \App\Support\Html::clean($page->content) !!}</article>
                @else
                    <x-empty-state message="Informasi persyaratan dan alur pendaftaran akan segera tersedia." />
                @endif
            </div>

            <aside class="lg:col-span-4">
                <div class="rounded-card bg-espresso p-7 text-cream shadow-card-hover lg:sticky lg:top-28">
                    <span class="badge bg-sand !text-ink">{{ $site->ppdb_is_open ? 'Pendaftaran Dibuka' : 'Pendaftaran Ditutup' }}</span>
                    @if ($site->ppdb_deadline)
                        <p class="mt-5 text-sm text-cream/70">Batas pendaftaran</p>
                        <p class="font-display text-2xl font-semibold text-cream">{{ $site->ppdb_deadline->translatedFormat('d F Y') }}</p>
                    @endif

                    <div class="mt-7 space-y-3">
                        @if ($site->ppdb_is_open && $site->ppdb_url)
                            <a href="{{ $site->ppdb_url }}" target="_blank" rel="noopener" class="btn w-full bg-sand text-ink hover:bg-sand-300">Isi Formulir Pendaftaran <x-heroicon-o-arrow-up-right class="h-4 w-4" /></a>
                        @elseif ($site->ppdb_is_open && $site->whatsapp)
                            <a href="https://wa.me/{{ $site->whatsapp }}?text={{ urlencode('Assalamu\'alaikum, saya ingin mendaftar PPDB '.$site->site_name) }}" target="_blank" rel="noopener" class="btn w-full bg-sand text-ink hover:bg-sand-300">Daftar via WhatsApp</a>
                        @endif
                        <a href="{{ route('kontak') }}" class="btn w-full border border-cream/40 text-cream hover:bg-cream hover:text-espresso">Tanya Panitia</a>
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection
