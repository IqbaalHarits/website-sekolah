<?php

namespace App\Listeners;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Http\Response;

/**
 * Livewire (and therefore Filament) emits root-relative URLs for its script and
 * update endpoint ("/livewire/update") and deliberately strips the app's base
 * path. When the app is served from a sub-folder (e.g. /websekolah/public) those
 * URLs miss the folder and Livewire never boots — Filament forms then fall back
 * to a plain POST (405 on /admin/login).
 *
 * Runs on RequestHandled (after Livewire injects its assets) and prepends the
 * base path. It is a no-op when served from the domain root — which is the
 * recommended production setup (document root = /public).
 */
class PrefixLivewireBasePath
{
    public function handle(RequestHandled $event): void
    {
        $base = $event->request->getBasePath();
        $response = $event->response;

        if ($base === '' || ! $response instanceof Response) {
            return;
        }

        $content = $response->getContent();

        if (! is_string($content) || ! str_contains($content, '/livewire/')) {
            return;
        }

        $response->setContent(str_replace(
            [
                'src="/livewire/',
                'data-update-uri="/livewire/',
                '"uri":"\/livewire\/',
                '"uri":"/livewire/',
            ],
            [
                'src="'.$base.'/livewire/',
                'data-update-uri="'.$base.'/livewire/',
                '"uri":"'.str_replace('/', '\/', $base).'\/livewire\/',
                '"uri":"'.$base.'/livewire/',
            ],
            $content,
        ));
    }
}
