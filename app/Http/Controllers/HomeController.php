<?php

namespace App\Http\Controllers;

use App\Models\AcademicSchedule;
use App\Models\FeaturedAlumnus;
use App\Models\Page;
use App\Models\Post;
use App\Models\Program;
use App\Models\Slider;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'sliders' => Slider::active()->get(),
            'sambutan' => Page::published()->where('slug', 'sambutan')->first(),
            'programs' => Program::active()->ofType(Program::TYPE_UNGGULAN)->limit(4)->get(),
            'posts' => Post::published()->with('category')->limit(4)->get(),
            'agenda' => AcademicSchedule::active()->upcoming()->limit(4)->get(),
            'alumni' => FeaturedAlumnus::featured()->limit(3)->get(),
        ]);
    }
}
