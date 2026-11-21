@props(['title', 'eyebrow' => null, 'intro' => null, 'crumbs' => []])

<section class="relative isolate overflow-hidden bg-sand">
    <svg aria-hidden="true" class="absolute inset-0 -z-10 h-full w-full text-espresso/[0.07]">
        <defs>
            <pattern id="hdr" width="56" height="56" patternUnits="userSpaceOnUse">
                <path d="M28 0 L56 28 L28 56 L0 28 Z" fill="none" stroke="currentColor" stroke-width="1.5" />
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#hdr)" />
    </svg>
    <div class="container-shell py-14 sm:py-20">
        <nav aria-label="Breadcrumb" class="mb-6 flex flex-wrap items-center gap-2 text-xs font-medium text-ink/70">
            <a href="{{ route('home') }}" class="hover:text-espresso hover:underline">Beranda</a>
            @foreach ($crumbs as $crumb)
                <span aria-hidden="true">/</span>
                <span>{{ $crumb }}</span>
            @endforeach
        </nav>
        @if ($eyebrow)
            <p class="eyebrow !text-ink/70 before:!bg-espresso/50">{{ $eyebrow }}</p>
        @endif
        <h1 class="mt-3 max-w-3xl font-display text-display-md font-semibold !text-ink">{{ $title }}</h1>
        @if ($intro)
            <p class="mt-4 max-w-2xl text-lg leading-relaxed text-ink/80">{{ $intro }}</p>
        @endif
    </div>
</section>
