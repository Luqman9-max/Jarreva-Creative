#!/bin/bash
set -e

echo "=== Jarreva Creative: Starting deployment sequence ==="

# Run migrations (creates new tables like contact_messages, jobs)
echo ">> Running database migrations..."
php artisan migrate --force

# Cache configuration at RUNTIME (so Railway env vars are available)
echo ">> Caching configuration..."
php artisan config:cache

# Create storage symlink
echo ">> Creating storage link..."
php artisan storage:link 2>/dev/null || true

# Start queue worker in background (processes email jobs)
echo ">> Starting queue worker..."
php artisan queue:work database --tries=3 --timeout=60 --sleep=10 --quiet &

echo "=== Starting web server ==="
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
