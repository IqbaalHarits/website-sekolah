<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PpdbController extends Controller
{
    public function __invoke(): View
    {
        return view('ppdb', [
            'page' => Page::published()->where('slug', 'ppdb')->first(),
        ]);
    }
}
