<?php

return [
    /*
    |--------------------------------------------------------------------------
    | CDN Configuration
    |--------------------------------------------------------------------------
    |
    | When enabled, static assets (images, JS, CSS) will be served from
    | the CDN URL instead of the local public directory. This is used in
    | production to serve assets via Cloudflare Pages for better performance.
    |
    */

    'enabled' => env('ASSET_CDN_ENABLED', false),

    'url' => env('ASSET_CDN_URL', ''),
];
