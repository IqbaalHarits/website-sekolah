<?php

namespace App\Http\Controllers;

use App\Models\FeaturedAlumnus;
use Illuminate\View\View;

class AlumniController extends Controller
{
    public function __invoke(): View
    {
        return view('alumni', ['alumni' => FeaturedAlumnus::featured()->get()]);
    }
}
