<?php

namespace App\Helpers;

class CdnHelper
{
    /**
     * Generate a URL to a CDN asset.
     * Falls back to local asset() if CDN is not configured or disabled.
     *
     * Usage in Blade: @cdn('images/books/57.webp')
     *
     * @param string $path The asset path relative to public/
     * @return string The full URL to the asset
     */
    public static function asset(string $path): string
    {
        $cdnUrl = config('cdn.url');
        $cdnEnabled = config('cdn.enabled');

        if ($cdnEnabled && !empty($cdnUrl)) {
            return rtrim($cdnUrl, '/') . '/' . ltrim($path, '/');
        }

        return asset($path);
    }
}
