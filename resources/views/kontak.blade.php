@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
    <x-page-header title="Hubungi Kami" eyebrow="Kontak" :crumbs="['Kontak']"
        intro="Kirim pertanyaan, saran, atau permintaan informasi. Kami akan membalas secepatnya." />

    <section class="section">
        <div class="container-shell grid gap-12 lg:grid-cols-12">
            <div class="lg:col-span-7">
                @if (session('success'))
                    <div role="status" class="mb-8 flex gap-3 rounded-2xl border border-sand bg-sand/25 p-5 text-espresso">
                        <x-heroicon-o-check-circle class="h-6 w-6 shrink-0" /><p class="font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('kontak.store') }}" method="POST" class="card space-y-5 p-6 sm:p-8" novalidate>
                    @csrf
                    {{-- Honeypot --}}
                    <div class="hidden" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="name" class="field-label">Nama lengkap</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name" class="field @error('name') !border-red-700 @enderror" @error('name') aria-invalid="true" @enderror>
                            @error('name')<p class="mt-1 text-sm text-red-800">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="email" class="field-label">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="field @error('email') !border-red-700 @enderror">
                            @error('email')<p class="mt-1 text-sm text-red-800">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="phone" class="field-label">Telepon / WhatsApp <span class="font-normal text-ink/50">(opsional)</span></label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel" class="field @error('phone') !border-red-700 @enderror">
                            @error('phone')<p class="mt-1 text-sm text-red-800">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="subject" class="field-label">Subjek</label>
                            <input id="subject" name="subject" type="text" value="{{ old('subject') }}" required class="field @error('subject') !border-red-700 @enderror">
                            @error('subject')<p class="mt-1 text-sm text-red-800">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label for="message" class="field-label">Pesan</label>
                        <textarea id="message" name="message" rows="6" required class="field @error('message') !border-red-700 @enderror">{{ old('message') }}</textarea>
                        @error('message')<p class="mt-1 text-sm text-red-800">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="btn-primary">Kirim Pesan <x-heroicon-o-paper-airplane class="h-4 w-4" /></button>
                </form>
            </div>

            <aside class="space-y-6 lg:col-span-5">
                <div class="rounded-card bg-beige p-7">
                    <h2 class="font-display text-xl font-semibold">Informasi Kontak</h2>
                    <ul class="mt-5 space-y-4 text-sm text-ink/80">
                        @if ($site->address)<li class="flex gap-3"><x-heroicon-o-map-pin class="mt-0.5 h-5 w-5 shrink-0 text-espresso" /><span class="whitespace-pre-line">{{ $site->address }}</span></li>@endif
                        @if ($site->phone)<li class="flex gap-3"><x-heroicon-o-phone class="h-5 w-5 shrink-0 text-espresso" />{{ $site->phone }}</li>@endif
                        @if ($site->email)<li class="flex gap-3"><x-heroicon-o-envelope class="h-5 w-5 shrink-0 text-espresso" /><a href="mailto:{{ $site->email }}" class="hover:underline">{{ $site->email }}</a></li>@endif
                    </ul>
                </div>
                @if ($site->map_embed_url)
                    <div class="aspect-[4/3] overflow-hidden rounded-card border border-sand/40 shadow-card">
                        <iframe src="{{ $site->map_embed_url }}" title="Peta lokasi {{ $site->site_name }}" class="h-full w-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                    </div>
                @endif
            </aside>
        </div>
    </section>
@endsection
