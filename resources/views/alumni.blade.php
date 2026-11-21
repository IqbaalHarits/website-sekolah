@extends('layouts.app')

@section('title', 'Alumni')

@section('content')
    <x-page-header title="Alumni Pilihan" eyebrow="Alumni" :crumbs="['Alumni']"
        intro="Kisah dan testimoni lulusan yang kini berkiprah di berbagai bidang." />

    <section class="section">
        <div class="container-shell">
            @if ($alumni->isEmpty())
                <x-empty-state />
            @else
                <div class="space-y-8">
                    @foreach ($alumni as $n => $a)
                        <article class="card grid gap-8 p-6 sm:p-8 md:grid-cols-12 md:items-center">
                            <div class="flex items-center gap-5 md:col-span-4 md:flex-col md:items-start">
                                <x-avatar :name="$a->name" :src="$a->photo" class="h-24 w-24 text-3xl md:h-36 md:w-36 md:text-5xl" />
                                <div>
                                    <h2 class="font-display text-2xl font-semibold">{{ $a->name }}</h2>
                                    <p class="mt-1 text-sm text-ink/70">{{ $a->current_position }}</p>
                                    <span class="badge-soft mt-3">Lulusan {{ $a->graduation_year }}</span>
                                </div>
                            </div>
                            <div class="md:col-span-8">
                                <blockquote class="border-l-2 border-sand pl-5 font-display text-xl leading-relaxed text-espresso sm:text-2xl">“{{ $a->testimonial }}”</blockquote>
                                @if ($a->success_story)
                                    <div class="mt-6">
                                        <p class="eyebrow">Kisah Sukses</p>
                                        <p class="mt-3 leading-relaxed text-ink/75">{{ $a->success_story }}</p>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
