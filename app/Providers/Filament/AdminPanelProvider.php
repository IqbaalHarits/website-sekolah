<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile()
            ->brandName('MA Tarbiyatut Tholibin')
            ->favicon(asset('storage/branding/favicon.png'))
            ->font('Plus Jakarta Sans')
            ->sidebarCollapsibleOnDesktop()
            ->colors([
                // Primary = cokelat tua gedung (#5C3A21 at shade 600)
                'primary' => [
                    50 => '247, 241, 236',
                    100 => '235, 221, 209',
                    200 => '211, 185, 163',
                    300 => '176, 142, 111',
                    400 => '138, 100, 68',
                    500 => '113, 74, 45',
                    600 => '92, 58, 33',
                    700 => '74, 47, 27',
                    800 => '58, 37, 21',
                    900 => '42, 27, 16',
                    950 => '28, 18, 10',
                ],
                'gray' => Color::Stone,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->navigationGroups([
                'Konten Website',
                'Akademik',
                'Kesiswaan',
                'Pesan Masuk',
                'Pengaturan',
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
