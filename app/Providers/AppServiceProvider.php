<?php

namespace App\Providers;

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
        // Share activity logs with the admin header
        \Illuminate\Support\Facades\View::composer('admin.components.header', function ($view) {
            if (\Illuminate\Support\Facades\Auth::guard('admin')->check()) {
                $activities = \App\Models\ActivityLog::with('admin')
                    ->latest()
                    ->take(10)
                    ->get();
                $view->with('activities', $activities);
            }
        });
    }
}
