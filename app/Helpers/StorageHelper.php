<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * Get the active upload disk name.
     *
     * Returns 'supabase' in production (when configured), falls back to 'public' for local dev.
     */
    public static function disk(): string
    {
        if (app()->environment('production') && !empty(config('filesystems.disks.supabase.endpoint'))) {
            return 'supabase';
        }

        return 'public';
    }

    /**
     * Get the Storage disk instance for uploads.
     */
    public static function storage(): \Illuminate\Contracts\Filesystem\Filesystem
    {
        return Storage::disk(static::disk());
    }

    /**
     * Generate a public URL for an uploaded file.
     *
     * @param string|null $path The stored file path (e.g., 'books/abc123.jpg')
     * @return string|null Full URL to the file, or null if path is empty
     */
    public static function url(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        $disk = static::disk();

        if ($disk === 'supabase') {
            // Build Supabase public URL:
            // https://<project>.supabase.co/storage/v1/object/public/<bucket>/<path>
            $publicUrl = rtrim(config('filesystems.disks.supabase.endpoint'), '/');
            $bucket = config('filesystems.disks.supabase.bucket', 'media');

            // Use the dedicated public URL if configured, otherwise construct it
            $supabasePublicUrl = env('SUPABASE_STORAGE_PUBLIC_URL');
            if (!empty($supabasePublicUrl)) {
                return rtrim($supabasePublicUrl, '/') . '/' . ltrim($path, '/');
            }

            // Fallback: construct from endpoint
            // Supabase S3 endpoint: https://<ref>.supabase.co/storage/v1/s3
            // Public URL format:    https://<ref>.supabase.co/storage/v1/object/public/<bucket>/<path>
            $baseUrl = str_replace('/storage/v1/s3', '/storage/v1/object/public/' . $bucket, $publicUrl);
            return $baseUrl . '/' . ltrim($path, '/');
        }

        // Local disk: use asset('storage/...')
        return asset('storage/' . $path);
    }
}
