<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\Stream\SocketStream;

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

        // Configure SMTP SSL options for Railway deployment
        // Railway's Nixpacks container may not have the full CA bundle in the default path.
        // This ensures SSL connections to Gmail SMTP work even if CA certs are in a non-standard location.
        $this->configureMailSSL();

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

    /**
     * Configure SSL context for SMTP mail transport.
     * Resolves SSL certificate verification failures on Railway/Nixpacks containers
     * where CA certificates may be in non-standard locations.
     */
    private function configureMailSSL(): void
    {
        // Only configure if using SMTP mailer
        if (config('mail.default') !== 'smtp') {
            return;
        }

        // After the mailer is resolved, configure its SSL stream options
        $this->app->resolving('mail.manager', function ($mailManager) {
            // We'll extend the SMTP transport creation via a callback
            // that runs after Laravel creates the default mailer
        });

        // Use a booted callback to configure the transport after everything is ready
        $this->app->booted(function () {
            try {
                $mailer = Mail::mailer('smtp');
                $transport = $mailer->getSymfonyTransport();

                if ($transport instanceof EsmtpTransport) {
                    $stream = $transport->getStream();

                    if ($stream instanceof SocketStream) {
                        // Find CA certificates - check common paths in Nix/Railway containers
                        $caFile = $this->findCACertFile();

                        $sslOptions = [
                            'verify_peer' => true,
                            'verify_peer_name' => true,
                        ];

                        if ($caFile) {
                            $sslOptions['cafile'] = $caFile;
                            \Illuminate\Support\Facades\Log::info('Mail SSL: Using CA file: ' . $caFile);
                        } else {
                            // If no CA file found, disable verification as last resort
                            // so emails can still be sent on Railway
                            $sslOptions['verify_peer'] = false;
                            $sslOptions['verify_peer_name'] = false;
                            $sslOptions['allow_self_signed'] = true;
                            \Illuminate\Support\Facades\Log::warning('Mail SSL: No CA certificate file found. Disabling SSL peer verification.');
                        }

                        $stream->setStreamOptions(['ssl' => $sslOptions]);
                    }
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Mail SSL configuration failed: ' . $e->getMessage());
            }
        });
    }

    /**
     * Find the CA certificate file in common locations.
     */
    private function findCACertFile(): ?string
    {
        $paths = [
            // Nix store (Railway Nixpacks)
            '/etc/ssl/certs/ca-certificates.crt',
            '/etc/ssl/certs/ca-bundle.crt',
            '/etc/pki/tls/certs/ca-bundle.crt',
            // Environment variable from Nix cacert package
            getenv('NIX_SSL_CERT_FILE') ?: '',
            getenv('SSL_CERT_FILE') ?: '',
            getenv('CURL_CA_BUNDLE') ?: '',
            // Common Linux paths
            '/etc/ssl/cert.pem',
            '/usr/lib/ssl/certs/ca-certificates.crt',
            '/usr/share/ca-certificates/mozilla/cacert.pem',
        ];

        foreach ($paths as $path) {
            if ($path && file_exists($path) && is_readable($path)) {
                return $path;
            }
        }

        return null;
    }
}
