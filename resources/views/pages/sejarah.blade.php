@extends('layouts.app')

@section('title', 'Sejarah & Sambutan Kepala Madrasah')

@section('content')
    <x-page-header title="Sejarah & Sambutan Kepala Madrasah" eyebrow="Profil" :crumbs="['Profil', 'Sejarah & Sambutan']"
        intro="Perjalanan panjang pesantren dan pesan dari pimpinan untuk seluruh keluarga besar." />

    @if ($sambutan)
    <section class="section">
        <div class="container-shell grid gap-12 lg:grid-cols-12">
            <aside class="lg:col-span-4">
                <div class="lg:sticky lg:top-28">
                    <div class="aspect-[4/5] overflow-hidden rounded-card shadow-card"><x-photo :src="$sambutan->image" :alt="$sambutan->author_name" /></div>
                    <p class="mt-5 font-display text-xl font-semibold text-espresso">{{ $sambutan->author_name }}</p>
                    <p class="text-sm text-ink/65">{{ $sambutan->author_position }}</p>
                </div>
            </aside>
            <div class="lg:col-span-8">
                <p class="eyebrow">Sambutan</p>
                <h2 class="mt-3 font-display text-display-sm font-semibold">{{ $sambutan->title }}</h2>
                <article class="prose prose-lg mt-6 max-w-none">{!! \App\Support\Html::clean($sambutan->content) !!}</article>
            </div>
        </div>
    </section>
    @endif

    @if ($sejarah)
    <section class="bg-beige section">
        <div class="container-shell">
            <div class="mx-auto max-w-3xl">
                <p class="eyebrow">Sejarah</p>
                <h2 class="mt-3 font-display text-display-sm font-semibold">{{ $sejarah->title }}</h2>
                @if ($sejarah->image)
                    <div class="mt-8 aspect-[16/9] overflow-hidden rounded-card shadow-card"><x-photo :src="$sejarah->image" :alt="$sejarah->title" /></div>
                @endif
                <article class="prose prose-lg mt-8 max-w-none prose-headings:mt-10">{!! \App\Support\Html::clean($sejarah->content) !!}</article>
            </div>
        </div>
    </section>
    @endif
@endsection
