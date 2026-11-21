@php($menu = config('menu'))

{{-- Utility bar --}}
<div class="hidden bg-espresso text-cream/90 lg:block">
    <div class="container-shell flex items-center justify-between py-2 text-xs">
        <div class="flex items-center gap-6">
            @if ($site->phone)
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $site->phone) }}" class="inline-flex items-center gap-1.5 hover:text-sand">
                    <x-heroicon-o-phone class="h-3.5 w-3.5" /> {{ $site->phone }}
                </a>
            @endif
            @if ($site->email)
                <a href="mailto:{{ $site->email }}" class="inline-flex items-center gap-1.5 hover:text-sand">
                    <x-heroicon-o-envelope class="h-3.5 w-3.5" /> {{ $site->email }}
                </a>
            @endif
        </div>
        <div class="flex items-center gap-5">
            @foreach (['instagram_url' => 'Instagram', 'facebook_url' => 'Facebook', 'youtube_url' => 'YouTube', 'tiktok_url' => 'TikTok'] as $field => $label)
                @if ($site->{$field})
                    <a href="{{ $site->{$field} }}" target="_blank" rel="noopener" class="hover:text-sand">{{ $label }}</a>
                @endif
            @endforeach
        </div>
    </div>
</div>

<header x-data="{ mobile: false, open: null, scrolled: false }"
        x-init="scrolled = window.scrollY > 8"
        @scroll.window.passive="scrolled = window.scrollY > 8"
        @keydown.escape.window="open = null; mobile = false"
        :class="scrolled ? 'shadow-card bg-cream/95' : 'bg-cream'"
        class="sticky top-0 z-50 border-b border-sand/30 backdrop-blur transition-shadow duration-300">
    <div class="container-shell flex h-[4.5rem] items-center justify-between gap-6">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3" aria-label="{{ $site->site_name }} — beranda">
            @if ($site->logo)
                <img src="{{ asset('storage/'.$site->logo) }}" alt="" class="h-12 w-auto shrink-0 object-contain">
            @else
                <span class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-espresso font-display text-lg font-semibold text-sand">
                    {{ mb_substr($site->site_name, 0, 1) }}
                </span>
            @endif
            <span class="min-w-0 leading-tight">
                <span class="line-clamp-2 block font-display text-[0.95rem] font-semibold leading-snug text-espresso sm:text-[1.05rem]">{{ $site->site_name }}</span>
                @if ($site->tagline)
                    <span class="hidden truncate text-[0.7rem] uppercase tracking-[0.14em] text-ink/60 sm:block">{{ $site->tagline }}</span>
                @endif
            </span>
        </a>

        {{-- Desktop nav --}}
        <nav class="hidden items-center gap-1 lg:flex" aria-label="Navigasi utama">
            @foreach ($menu as $i => $item)
                @php($active = request()->routeIs($item['match'] ?? '__none__'))
                @if (empty($item['children']))
                    <a href="{{ route($item['route']) }}"
                       @class([
                           'rounded-full px-3.5 py-2 text-sm font-medium transition',
                           'bg-sand/30 text-espresso' => $active,
                           'text-ink/80 hover:bg-beige hover:text-espresso' => ! $active,
                       ])
                       @if($active) aria-current="page" @endif>{{ $item['label'] }}</a>
                @else
                    <div class="relative" @mouseenter="open = {{ $i }}" @mouseleave="open = null">
                        <button type="button" @click="open = open === {{ $i }} ? null : {{ $i }}"
                                :aria-expanded="open === {{ $i }}"
                                @class([
                                    'inline-flex items-center gap-1 rounded-full px-3.5 py-2 text-sm font-medium transition',
                                    'bg-sand/30 text-espresso' => $active,
                                    'text-ink/80 hover:bg-beige hover:text-espresso' => ! $active,
                                ])>
                            {{ $item['label'] }}
                            <x-heroicon-m-chevron-down class="h-4 w-4 transition-transform" ::class="open === {{ $i }} && 'rotate-180'" />
                        </button>
                        <div x-cloak x-show="open === {{ $i }}" x-transition.origin.top.opacity.duration.200ms
                             @click.outside="open === {{ $i }} && (open = null)"
                             class="absolute left-0 top-full w-72 pt-2">
                            <ul class="overflow-hidden rounded-2xl border border-sand/40 bg-cream p-2 shadow-card-hover">
                                @foreach ($item['children'] as $child)
                                    <li>
                                        <a href="{{ route($child['route']) }}"
                                           @class([
                                               'block rounded-xl px-3.5 py-2.5 text-sm transition',
                                               'bg-sand/25 font-semibold text-espresso' => request()->routeIs($child['route']),
                                               'text-ink/85 hover:bg-beige hover:text-espresso' => ! request()->routeIs($child['route']),
                                           ])>{{ $child['label'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach
        </nav>

        <div class="flex items-center gap-2">
            <a href="{{ route('ppdb') }}" class="btn-primary hidden !px-5 !py-2.5 sm:inline-flex">
                PPDB
            </a>
            <button type="button" class="grid h-11 w-11 place-items-center rounded-full text-espresso hover:bg-beige lg:hidden"
                    @click="mobile = !mobile" :aria-expanded="mobile" aria-label="Buka menu">
                <x-heroicon-o-bars-3 x-show="!mobile" class="h-6 w-6" />
                <x-heroicon-o-x-mark x-cloak x-show="mobile" class="h-6 w-6" />
            </button>
        </div>
    </div>

    {{-- Mobile nav --}}
    <div x-cloak x-show="mobile" x-collapse class="border-t border-sand/30 bg-cream lg:hidden">
        <nav class="container-shell max-h-[calc(100vh-4.5rem)] space-y-1 overflow-y-auto py-4" aria-label="Navigasi seluler">
            @foreach ($menu as $i => $item)
                @if (empty($item['children']))
                    <a href="{{ route($item['route']) }}"
                       class="block rounded-xl px-4 py-3 font-medium {{ request()->routeIs($item['match'] ?? '__none__') ? 'bg-sand/30 text-espresso' : 'text-ink/85' }}">
                        {{ $item['label'] }}
                    </a>
                @else
                    <div x-data="{ sub: {{ request()->routeIs($item['match']) ? 'true' : 'false' }} }">
                        <button type="button" @click="sub = !sub" class="flex w-full items-center justify-between rounded-xl px-4 py-3 font-medium text-ink/85">
                            {{ $item['label'] }}
                            <x-heroicon-m-chevron-down class="h-5 w-5 transition-transform" ::class="sub && 'rotate-180'" />
                        </button>
                        <ul x-cloak x-show="sub" x-collapse class="ml-4 space-y-0.5 border-l border-sand/50 pl-3">
                            @foreach ($item['children'] as $child)
                                <li>
                                    <a href="{{ route($child['route']) }}"
                                       class="block rounded-lg px-3 py-2.5 text-sm {{ request()->routeIs($child['route']) ? 'font-semibold text-espresso' : 'text-ink/75' }}">
                                        {{ $child['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach
            <a href="{{ route('ppdb') }}" class="btn-primary mt-3 w-full">Daftar PPDB</a>
        </nav>
    </div>
</header>
