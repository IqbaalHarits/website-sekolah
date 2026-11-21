<?php

namespace Database\Seeders\Support;

use Illuminate\Support\Facades\Storage;

/**
 * Generates tasteful on-palette SVG placeholders so demo content renders
 * without shipping binary assets. Replace them via the admin panel.
 */
class PlaceholderImage
{
    private const PALETTES = [
        ['#D6B07D', '#5C3A21', '#F2E8D8'],
        ['#5C3A21', '#D6B07D', '#FBF7F0'],
        ['#E8CFA3', '#7A4A27', '#FBF7F0'],
        ['#B98F5C', '#2E2219', '#F2E8D8'],
    ];

    public static function make(string $dir, string $name, int $w = 1200, int $h = 800, int $variant = 0): string
    {
        [$a, $b, $c] = self::PALETTES[$variant % count(self::PALETTES)];
        $cx = (int) ($w * 0.72);
        $cy = (int) ($h * 0.35);
        $r = (int) ($h * 0.55);

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="{$w}" height="{$h}" viewBox="0 0 {$w} {$h}">
  <defs>
    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="{$a}"/><stop offset="1" stop-color="{$b}"/>
    </linearGradient>
    <pattern id="p" width="48" height="48" patternUnits="userSpaceOnUse">
      <path d="M24 0 L48 24 L24 48 L0 24 Z" fill="none" stroke="{$c}" stroke-opacity=".12" stroke-width="1.2"/>
    </pattern>
  </defs>
  <rect width="{$w}" height="{$h}" fill="url(#g)"/>
  <rect width="{$w}" height="{$h}" fill="url(#p)"/>
  <circle cx="{$cx}" cy="{$cy}" r="{$r}" fill="{$c}" fill-opacity=".10"/>
  <circle cx="{$cx}" cy="{$cy}" r="{$r}" fill="none" stroke="{$c}" stroke-opacity=".25"/>
</svg>
SVG;
        $path = "{$dir}/{$name}.svg";
        Storage::disk('public')->put($path, $svg);

        return $path;
    }
}
