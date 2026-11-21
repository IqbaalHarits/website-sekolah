@extends('layouts.app')

@section('title', $post->title)
@section('description', $post->excerpt_text)

@section('content')
    <section class="bg-sand">
        <div class="container-shell py-14 sm:py-20">
            <nav aria-label="Breadcrumb" class="mb-6 flex items-center gap-2 text-xs font-medium text-ink/70">
                <a href="{{ route('home') }}" class="hover:underline">Beranda</a><span>/</span><a href="{{ route('berita.index') }}" class="hover:underline">Berita</a>
            </nav>
            <div class="flex flex-wrap items-center gap-3 text-sm text-ink/75">
                @if ($post->category)<span class="badge">{{ $post->category->name }}</span>@endif
                <time datetime="{{ $post->published_at?->toDateString() }}">{{ $post->published_at?->translatedFormat('l, d F Y') }}</time>
                @if ($post->author)<span>· {{ $post->author->name }}</span>@endif
            </div>
            <h1 class="mt-4 max-w-4xl font-display text-display-md font-semibold !text-ink">{{ $post->title }}</h1>
        </div>
    </section>

    <section class="section">
        <div class="container-shell">
            <div class="mx-auto max-w-3xl">
                @if ($post->featured_image)
                    <div class="-mt-24 mb-10 aspect-[16/10] overflow-hidden rounded-card shadow-card-hover sm:-mt-32"><x-photo :src="$post->featured_image" :alt="$post->title" /></div>
                @endif
                <article class="prose prose-lg max-w-none prose-headings:mt-10">{!! \App\Support\Html::clean($post->content) !!}</article>
            </div>
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="bg-beige section">
            <div class="container-shell">
                <x-section-heading eyebrow="Baca Juga" title="Berita lainnya" />
                <div class="mt-10 grid gap-7 md:grid-cols-3">
                    @foreach ($related as $r)<x-post-card :post="$r" />@endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
