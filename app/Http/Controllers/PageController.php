<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function sejarah(): View
    {
        $pages = Page::published()->whereIn('slug', ['sejarah', 'sambutan'])->get()->keyBy('slug');
        abort_if($pages->isEmpty(), 404);

        return view('pages.sejarah', [
            'sejarah' => $pages->get('sejarah'),
            'sambutan' => $pages->get('sambutan'),
        ]);
    }

    public function show(string $slug): View
    {
        $page = Page::published()->where('slug', $slug)->firstOrFail();

        return view('pages.show', compact('page'));
    }
}
