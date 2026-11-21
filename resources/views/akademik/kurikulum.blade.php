@extends('layouts.app')

@section('title', 'Kurikulum & Program Unggulan')

@section('content')
    <x-page-header title="Kurikulum & Program Unggulan" eyebrow="Akademik" :crumbs="['Akademik', 'Kurikulum']"
        :intro="$page?->excerpt" />

    @if ($page)
    <section class="section pb-0">
        <div class="container-shell"><div class="mx-auto max-w-3xl">
            <article class="prose prose-lg max-w-none">{!! \App\Support\Html::clean($page->content) !!}</article>
        </div></div>
    </section>
    @endif

    <section class="section">
        <div class="container-shell">
            <x-section-heading eyebrow="Program Unggulan" title="Keunggulan yang kami tawarkan" />
            <div class="mt-12 grid gap-6 sm:grid-cols-2">
                @forelse ($programs as $p)
                    <article class="card card-hover group overflow-hidden">
                        <div class="aspect-[16/9] overflow-hidden bg-beige"><x-photo :src="$p->image" :alt="$p->title" class="transition duration-700 ease-out-expo group-hover:scale-105" /></div>
                        <div class="p-7">
                            <h3 class="font-display text-2xl font-semibold">{{ $p->title }}</h3>
                            <p class="mt-2 leading-relaxed text-ink/70">{{ $p->description }}</p>
                            @if ($p->schedule_info)<p class="mt-4 text-sm font-semibold text-espresso">{{ $p->schedule_info }}</p>@endif
                        </div>
                    </article>
                @empty
                    <div class="sm:col-span-2"><x-empty-state /></div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
