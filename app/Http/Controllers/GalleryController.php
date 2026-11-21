<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __invoke(): View
    {
        $photos = Gallery::active()->get();

        return view('galeri', [
            'photos' => $photos,
            'categories' => $photos->pluck('category')->unique()->values(),
        ]);
    }
}
