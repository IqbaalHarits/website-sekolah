<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Program;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function ekskul(): View
    {
        return view('kesiswaan.ekskul', [
            'items' => Program::active()->ofType(Program::TYPE_EKSKUL)->get(),
        ]);
    }

    public function prestasi(): View
    {
        $items = Achievement::active()->get();

        return view('kesiswaan.prestasi', [
            'groups' => $items->groupBy('year'),
        ]);
    }
}
