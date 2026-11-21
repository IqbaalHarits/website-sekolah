@props(['src' => null, 'alt' => '', 'ratio' => null])

{{-- Storage image with an on-palette fallback so layouts never collapse. --}}
@if ($src)
    <img src="{{ asset('storage/'.$src) }}" alt="{{ $alt }}" loading="lazy" decoding="async"
         {{ $attributes->class(['h-full w-full object-cover']) }}>
@else
    <div role="img" aria-label="{{ $alt }}"
         {{ $attributes->class(['h-full w-full bg-gradient-to-br from-sand to-espresso-400']) }}></div>
@endif
