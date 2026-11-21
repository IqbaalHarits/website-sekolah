<?php

namespace App\Support;

use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

/** Sanitizes rich-text (admin-authored) before rendering unescaped. */
class Html
{
    private static ?HtmlSanitizer $sanitizer = null;

    public static function clean(?string $html): string
    {
        if (blank($html)) {
            return '';
        }

        self::$sanitizer ??= new HtmlSanitizer(
            (new HtmlSanitizerConfig())
                ->allowSafeElements()
                ->allowElement('figure')->allowElement('figcaption')
                ->allowRelativeLinks()
                ->allowRelativeMedias()
                ->allowLinkSchemes(['http', 'https', 'mailto', 'tel'])
                ->allowMediaSchemes(['http', 'https'])
        );

        return self::$sanitizer->sanitize($html);
    }
}
