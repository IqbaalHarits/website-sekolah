<?php

namespace App\Filament\Widgets;

use App\Models\AcademicSchedule;
use App\Models\Achievement;
use App\Models\ContactMessage;
use App\Models\FeaturedAlumnus;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\Program;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SchoolStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $unread = ContactMessage::unread()->count();

        return [
            Stat::make('Berita Terbit', Post::published()->count())
                ->description('Total artikel dipublikasikan')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary'),
            Stat::make('Pesan Masuk', ContactMessage::count())
                ->description($unread > 0 ? "{$unread} pesan belum dibaca" : 'Semua pesan sudah dibaca')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unread > 0 ? 'warning' : 'success'),
            Stat::make('Program & Ekstrakurikuler', Program::active()->count())
                ->description(Achievement::active()->count().' prestasi & '.AcademicSchedule::active()->count().' agenda aktif')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('primary'),
            Stat::make('Galeri & Alumni', Gallery::active()->count().' Foto')
                ->description(FeaturedAlumnus::featured()->count().' profil alumni pilihan')
                ->descriptionIcon('heroicon-m-photo')
                ->color('primary'),
        ];
    }
}
