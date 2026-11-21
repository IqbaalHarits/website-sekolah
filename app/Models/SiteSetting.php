<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'ppdb_is_open' => 'boolean',
            'ppdb_deadline' => 'date',
        ];
    }

    protected static function booted(): void
    {
        $flush = fn () => Cache::forget('site_settings');
        static::saved($flush);
        static::deleted($flush);
    }

    /** Cached singleton accessor for views. Never returns null. */
    public static function current(): static
    {
        return Cache::rememberForever('site_settings', function () {
            return static::query()->first() ?? new static([
                'site_name' => config('app.name'),
            ]);
        });
    }
}
