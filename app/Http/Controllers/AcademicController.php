<?php

namespace App\Http\Controllers;

use App\Models\AcademicSchedule;
use App\Models\Page;
use App\Models\Program;
use Illuminate\View\View;

class AcademicController extends Controller
{
    public function jadwal(): View
    {
        $items = AcademicSchedule::active()->category(AcademicSchedule::CATEGORY_TAHUNAN)
            ->orderBy('start_date')->get();

        return view('akademik.schedule', [
            'title' => 'Jadwal Kegiatan Tahunan',
            'intro' => 'Agenda besar pesantren sepanjang tahun ajaran: peringatan hari besar, kompetisi, dan puncak acara.',
            'groups' => $items->groupBy(fn ($i) => $i->start_date->translatedFormat('F Y')),
            'variant' => 'timeline',
        ]);
    }

    public function kalender(): View
    {
        $items = AcademicSchedule::active()->category(AcademicSchedule::CATEGORY_KALENDER)
            ->orderBy('start_date')->get();

        return view('akademik.schedule', [
            'title' => 'Kalender Akademik',
            'intro' => 'Tanggal penting kegiatan belajar mengajar: awal semester, ujian, libur, dan pembagian rapor.',
            'groups' => $items->groupBy(fn ($i) => $i->start_date->translatedFormat('F Y')),
            'variant' => 'table',
        ]);
    }

    public function kurikulum(): View
    {
        return view('akademik.kurikulum', [
            'page' => Page::published()->where('slug', 'kurikulum')->first(),
            'programs' => Program::active()->ofType(Program::TYPE_UNGGULAN)->get(),
        ]);
    }
}
