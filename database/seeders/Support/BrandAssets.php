<?php

namespace Database\Seeders\Support;

use Illuminate\Support\Facades\Storage;

/**
 * Publishes the school's real branding files (kept in version control under
 * database/seeders/assets) to the public disk so the seeders can reference them.
 */
class BrandAssets
{
    public static function publish(string $file, string $as): string
    {
        $path = 'branding/'.$as;
        Storage::disk('public')->put($path, file_get_contents(database_path('seeders/assets/'.$file)));

        return $path;
    }
}
