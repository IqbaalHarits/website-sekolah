<?php

namespace App\Providers;

use App\Models\SiteSetting;
use App\Listeners\PrefixLivewireBasePath;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Livewire/Filament under a sub-folder (e.g. /websekolah/public); no-op at domain root.
        Event::listen(RequestHandled::class, PrefixLivewireBasePath::class);

        Paginator::defaultView('vendor.pagination.sekolah');
        Paginator::defaultSimpleView('vendor.pagination.sekolah');

        // Share site settings with every public view (resolved once per request).
        View::composer(['layouts.*', 'partials.*', 'home', 'kontak', 'ppdb', 'errors.*'], function ($view) {
            static $site = null;
            if ($site === null) {
                try {
                    $site = SiteSetting::current();
                } catch (\Throwable) {
                    $site = new SiteSetting(['site_name' => config('app.name')]);
                }
            }
            $view->with('site', $site);
        });
        //
    }
}
