@extends('layouts.app')

@section('title', $title)

@php
    $range = fn ($i) => $i->end_date && ! $i->end_date->isSameDay($i->start_date)
        ? $i->start_date->translatedFormat('d M').' – '.$i->end_date->translatedFormat('d M Y')
        : $i->start_date->translatedFormat('d F Y');
@endphp

@section('content')
    <x-page-header :title="$title" eyebrow="Akademik" :intro="$intro" :crumbs="['Akademik', $title]" />

    <section class="section">
        <div class="container-shell">
            <div class="mx-auto max-w-4xl">
                @forelse ($groups as $month => $items)
                    <div class="grid gap-6 border-t border-sand/50 py-10 first:border-t-0 first:pt-0 md:grid-cols-[11rem_1fr]">
                        <h2 class="font-display text-2xl font-semibold md:sticky md:top-28 md:self-start">{{ $month }}</h2>

                        @if ($variant === 'timeline')
                            <ol class="relative space-y-5 border-l border-sand pl-8">
                                @foreach ($items as $item)
                                    <li class="relative">
                                        <span class="absolute -left-[2.45rem] top-1.5 h-3 w-3 rounded-full border-2 border-sand bg-cream ring-4 ring-cream"></span>
                                        <div class="card p-5">
                                            <p class="text-xs font-semibold uppercase tracking-wider text-espresso/70">{{ $range($item) }}</p>
                                            <h3 class="mt-1 font-display text-xl font-semibold">{{ $item->title }}</h3>
                                            @if ($item->description)<p class="mt-1.5 text-sm leading-relaxed text-ink/70">{{ $item->description }}</p>@endif
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <div class="overflow-hidden rounded-card border border-sand/40 bg-cream shadow-card">
                                <table class="w-full text-left text-sm">
                                    <caption class="sr-only">{{ $title }} — {{ $month }}</caption>
                                    <thead class="bg-sand/30 text-xs uppercase tracking-wider text-espresso">
                                        <tr><th scope="col" class="px-5 py-3 font-semibold">Tanggal</th><th scope="col" class="px-5 py-3 font-semibold">Kegiatan</th></tr>
                                    </thead>
                                    <tbody class="divide-y divide-sand/30">
                                        @foreach ($items as $item)
                                            <tr class="align-top">
                                                <td class="whitespace-nowrap px-5 py-4 font-semibold text-espresso">{{ $range($item) }}</td>
                                                <td class="px-5 py-4">
                                                    <p class="font-medium text-ink">{{ $item->title }}</p>
                                                    @if ($item->description)<p class="mt-0.5 text-ink/60">{{ $item->description }}</p>@endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                @empty
                    <x-empty-state message="Jadwal belum tersedia." />
                @endforelse
            </div>
        </div>
    </section>
@endsection
