@extends('layouts.app')

@section('title', 'Prestasi Siswa')

@section('content')
    <x-page-header title="Prestasi Siswa" eyebrow="Kesiswaan" :crumbs="['Kesiswaan', 'Prestasi Siswa']"
        intro="Capaian santri dalam bidang akademik, tahfidz, olahraga, dan seni." />

    <section class="section">
        <div class="container-shell">
            <div class="mx-auto max-w-4xl">
                @forelse ($groups as $year => $items)
                    <div class="grid gap-6 border-t border-sand/50 py-10 first:border-t-0 first:pt-0 md:grid-cols-[8rem_1fr]">
                        <h2 class="font-display text-4xl font-semibold text-sand md:sticky md:top-28 md:self-start">{{ $year }}</h2>
                        <ul class="space-y-4">
                            @foreach ($items as $a)
                                <li class="card flex gap-5 p-5">
                                    <span class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-espresso text-sand"><x-heroicon-o-trophy class="h-6 w-6" /></span>
                                    <div class="min-w-0">
                                        <div class="flex flex-wrap items-center gap-2">
                                            @if ($a->rank)<span class="badge">{{ $a->rank }}</span>@endif
                                            @if ($a->level)<span class="badge-soft">{{ $a->level }}</span>@endif
                                        </div>
                                        <h3 class="mt-2 font-display text-lg font-semibold leading-snug">{{ $a->title }}</h3>
                                        @if ($a->student_name)<p class="text-sm text-ink/70">{{ $a->student_name }}</p>@endif
                                        @if ($a->description)<p class="mt-1.5 text-sm text-ink/60">{{ $a->description }}</p>@endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <x-empty-state />
                @endforelse
            </div>
        </div>
    </section>
@endsection
