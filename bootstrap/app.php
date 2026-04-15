<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Trust Railway's reverse proxy (needed for correct HTTPS detection)
        $middleware->trustProxies(at: '*');

        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminAuth::class,
            'lead.captured' => \App\Http\Middleware\EnsureLeadCaptured::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
