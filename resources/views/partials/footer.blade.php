<footer class="mt-24 bg-beige">
    <div class="container-shell grid gap-12 py-16 md:grid-cols-12">
        <div class="md:col-span-5">
            @if ($site->logo)
                <img src="{{ asset('storage/'.$site->logo) }}" alt="Logo {{ $site->site_name }}" class="mb-5 h-20 w-auto">
            @endif
            <p class="font-display text-2xl font-semibold text-espresso">{{ $site->site_name }}</p>
            @if ($site->tagline)
                <p class="mt-1 text-sm uppercase tracking-[0.16em] text-ink/60">{{ $site->tagline }}</p>
            @endif
            @if ($site->about_summary)
                <p class="mt-5 max-w-md text-sm leading-relaxed text-ink/75">{{ \Illuminate\Support\Str::limit($site->about_summary, 190) }}</p>
            @endif
            <div class="mt-6 flex flex-wrap gap-2">
                @foreach (['instagram_url' => 'Instagram', 'facebook_url' => 'Facebook', 'youtube_url' => 'YouTube', 'tiktok_url' => 'TikTok'] as $field => $label)
                    @if ($site->{$field})
                        <a href="{{ $site->{$field} }}" target="_blank" rel="noopener"
                           class="rounded-full border border-espresso/20 px-4 py-1.5 text-xs font-semibold text-espresso transition hover:bg-espresso hover:text-cream">{{ $label }}</a>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="md:col-span-3">
            <h2 class="eyebrow !text-espresso">Jelajahi</h2>
            <ul class="mt-5 space-y-2.5 text-sm">
                @foreach (config('menu') as $item)
                    @if (empty($item['children']))
                        <li><a href="{{ route($item['route']) }}" class="text-ink/75 hover:text-espresso hover:underline">{{ $item['label'] }}</a></li>
                    @else
                        <li><a href="{{ route($item['children'][0]['route']) }}" class="text-ink/75 hover:text-espresso hover:underline">{{ $item['label'] }}</a></li>
                    @endif
                @endforeach
                <li><a href="{{ route('berita.index') }}" class="text-ink/75 hover:text-espresso hover:underline">Berita</a></li>
                <li><a href="{{ route('ppdb') }}" class="font-semibold text-espresso hover:underline">PPDB</a></li>
            </ul>
        </div>

        <div class="md:col-span-4">
            <h2 class="eyebrow !text-espresso">Hubungi Kami</h2>
            <ul class="mt-5 space-y-4 text-sm text-ink/80">
                @if ($site->address)
                    <li class="flex gap-3"><x-heroicon-o-map-pin class="mt-0.5 h-5 w-5 shrink-0 text-espresso" /><span class="whitespace-pre-line">{{ $site->address }}</span></li>
                @endif
                @if ($site->phone)
                    <li class="flex gap-3"><x-heroicon-o-phone class="h-5 w-5 shrink-0 text-espresso" /><a href="tel:{{ preg_replace('/[^0-9+]/', '', $site->phone) }}" class="hover:underline">{{ $site->phone }}</a></li>
                @endif
                @if ($site->email)
                    <li class="flex gap-3"><x-heroicon-o-envelope class="h-5 w-5 shrink-0 text-espresso" /><a href="mailto:{{ $site->email }}" class="hover:underline">{{ $site->email }}</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="border-t border-sand/50">
        <div class="container-shell flex flex-col items-center justify-between gap-2 py-5 text-xs text-ink/60 sm:flex-row">
            <p>&copy; {{ now()->year }} {{ $site->site_name }}. Hak cipta dilindungi.</p>
            <p>{{ $site->tagline }}</p>
        </div>
    </div>
</footer>
