<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS in production (Railway uses reverse proxy that terminates SSL)
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
        // Register @cdn Blade directive for CDN asset URLs
        // Usage: @cdn('images/books/57.webp') → CDN URL in production, local asset() in dev
        Blade::directive('cdn', function ($expression) {
            return "<?php echo \App\Helpers\CdnHelper::asset($expression); ?>";
        });

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
