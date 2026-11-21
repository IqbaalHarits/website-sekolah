@props(['post'])

<article class="card card-hover group flex h-full flex-col overflow-hidden">
    <a href="{{ route('berita.show', $post->slug) }}" class="block aspect-[3/2] overflow-hidden bg-beige" tabindex="-1" aria-hidden="true">
        <x-photo :src="$post->featured_image" :alt="$post->title" class="transition duration-700 ease-out-expo group-hover:scale-105" />
    </a>
    <div class="flex flex-1 flex-col p-6">
        <div class="flex items-center gap-3 text-xs text-ink/60">
            @if ($post->category)<span class="badge-soft">{{ $post->category->name }}</span>@endif
            <time datetime="{{ $post->published_at?->toDateString() }}">{{ $post->published_at?->translatedFormat('d F Y') }}</time>
        </div>
        <h3 class="mt-3 font-display text-xl font-semibold leading-snug">
            <a href="{{ route('berita.show', $post->slug) }}" class="hover:underline decoration-sand decoration-2 underline-offset-4">{{ $post->title }}</a>
        </h3>
        <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-ink/70">{{ $post->excerpt_text }}</p>
    </div>
</article>
