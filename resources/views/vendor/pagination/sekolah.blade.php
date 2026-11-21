@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Paginasi" class="mt-12 flex items-center justify-center gap-1.5">
        @if ($paginator->onFirstPage())
            <span class="rounded-full px-4 py-2 text-sm text-ink/30">&larr; Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="rounded-full px-4 py-2 text-sm font-medium text-espresso hover:bg-beige">&larr; Sebelumnya</a>
        @endif

        @if (method_exists($paginator, 'getUrlRange'))
            <div class="hidden items-center gap-1 sm:flex">
                @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" class="grid h-10 w-10 place-items-center rounded-full bg-espresso text-sm font-semibold text-cream">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="grid h-10 w-10 place-items-center rounded-full text-sm font-medium text-espresso hover:bg-beige">{{ $page }}</a>
                    @endif
                @endforeach
            </div>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="rounded-full px-4 py-2 text-sm font-medium text-espresso hover:bg-beige">Berikutnya &rarr;</a>
        @else
            <span class="rounded-full px-4 py-2 text-sm text-ink/30">Berikutnya &rarr;</span>
        @endif
    </nav>
@endif
