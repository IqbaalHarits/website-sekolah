@props(['name', 'src' => null])

@php($initials = collect(explode(' ', preg_replace('/^(dr\.|ust\.|ustzh\.)\s*/i', '', $name)))->filter()->take(2)->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode(''))

<span {{ $attributes->class(['relative inline-grid shrink-0 place-items-center overflow-hidden rounded-full bg-sand font-display font-semibold text-espresso']) }}>
    @if ($src)
        <img src="{{ asset('storage/'.$src) }}" alt="{{ $name }}" class="h-full w-full object-cover" loading="lazy">
    @else
        <span aria-hidden="true">{{ $initials }}</span>
    @endif
</span>
