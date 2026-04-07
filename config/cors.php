<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Since Jarreva Creative uses Blade (server-side rendering), CORS is
    | only needed for AJAX POST routes (contact form, newsletter subscribe,
    | lead capture). Static asset references in <img>/<script> tags do NOT
    | require CORS configuration.
    |
    */

    'paths' => ['contact/submit', 'subscribe', 'lead-submit'],

    'allowed_methods' => ['POST', 'GET', 'OPTIONS'],

    'allowed_origins' => [
        env('APP_URL', 'http://localhost'),
        env('ASSET_CDN_URL', ''),
    ],

    'allowed_origins_patterns' => [
        // Allow any Cloudflare Pages subdomain
        '#^https://.*\.pages\.dev$#',
    ],

    'allowed_headers' => ['Content-Type', 'X-Requested-With', 'X-CSRF-TOKEN', 'Accept'],

    'exposed_headers' => [],

    'max_age' => 86400, // 24 hours

    'supports_credentials' => false,
];
