@props(['eyebrow' => null, 'title', 'intro' => null, 'align' => 'left'])

<div {{ $attributes->class(['max-w-2xl', 'mx-auto text-center' => $align === 'center']) }}>
    @if ($eyebrow)
        <p class="eyebrow {{ $align === 'center' ? 'justify-center' : '' }}">{{ $eyebrow }}</p>
    @endif
    <h2 class="mt-3 font-display text-display-sm font-semibold">{{ $title }}</h2>
    @if ($intro)
        <p class="mt-3 leading-relaxed text-ink/75">{{ $intro }}</p>
    @endif
    {{ $slot }}
</div>
