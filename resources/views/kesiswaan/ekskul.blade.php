@extends('layouts.app')

@section('title', 'Daftar Ekstrakurikuler')

@section('content')
    <x-page-header title="Daftar Ekstrakurikuler" eyebrow="Kesiswaan" :crumbs="['Kesiswaan', 'Ekstrakurikuler']"
        intro="Wadah menyalurkan minat dan bakat santri di luar jam pelajaran." />

    <section class="section">
        <div class="container-shell">
            @if ($items->isEmpty())
                <x-empty-state />
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($items as $item)
                        <article class="card card-hover group overflow-hidden">
                            <div class="aspect-[3/2] overflow-hidden bg-beige"><x-photo :src="$item->image" :alt="$item->title" class="transition duration-700 ease-out-expo group-hover:scale-105" /></div>
                            <div class="p-6">
                                <h3 class="font-display text-xl font-semibold">{{ $item->title }}</h3>
                                <p class="mt-2 text-sm leading-relaxed text-ink/70">{{ $item->description }}</p>
                                @if ($item->schedule_info)
                                    <p class="mt-4 inline-flex items-center gap-2 rounded-full bg-sand/25 px-3 py-1 text-xs font-semibold text-espresso">
                                        <x-heroicon-o-clock class="h-3.5 w-3.5" /> {{ $item->schedule_info }}
                                    </p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
