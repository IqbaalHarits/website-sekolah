<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-pt-24">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@hasSection('title')@yield('title') — @endif{{ $site->site_name }}</title>
    <meta name="description" content="@yield('description', $site->meta_description)">
    <meta name="theme-color" content="#D6B07D">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $site->site_name }}">
    <meta property="og:title" content="@hasSection('title')@yield('title') — @endif{{ $site->site_name }}">
    <meta property="og:description" content="@yield('description', $site->meta_description)">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($site->logo)
        <meta property="og:image" content="@yield('og_image', asset('storage/'.$site->logo))">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    @if ($site->favicon)
        <link rel="icon" href="{{ asset('storage/'.$site->favicon) }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="flex min-h-screen flex-col">
    <a href="#konten" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-full focus:bg-espresso focus:px-5 focus:py-2 focus:text-cream">
        Lewati ke konten utama
    </a>

    @include('partials.navbar')

    <main id="konten" class="flex-1">
        @yield('content')
    </main>

    @include('partials.footer')

    @if ($site->whatsapp)
        <a href="https://wa.me/{{ $site->whatsapp }}" target="_blank" rel="noopener"
           class="fixed bottom-5 right-5 z-40 inline-flex items-center gap-2 rounded-full bg-espresso px-4 py-3 text-sm font-semibold text-cream shadow-card-hover transition duration-300 ease-out-expo hover:-translate-y-0.5 hover:bg-espresso-700"
           aria-label="Hubungi via WhatsApp">
            <x-heroicon-o-chat-bubble-left-right class="h-5 w-5" />
            <span class="hidden sm:inline">Tanya Kami</span>
        </a>
    @endif
</body>
</html>
