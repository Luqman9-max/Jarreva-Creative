# Jarreva Creative — Deployment Guide

## Architecture

```
Cloudflare Pages (CDN)          Koyeb (App Server)          Supabase
├── CSS (app-*.css)             └── Laravel 12 (PHP 8.3)    ├── PostgreSQL Database
├── JS (app-*.js)                   └── Docker container    └── Storage (S3-compatible)
├── Images (books/*.webp)
└── Three.js (vendor/)
```

## Prerequisites

- [Koyeb account](https://koyeb.com) (free tier)
- [Supabase account](https://supabase.com) (free tier)
- [Cloudflare Pages](https://pages.cloudflare.com) — already configured
- GitHub repository access

---

## Step 1: Supabase Setup

### 1.1 Create Project
1. Go to [supabase.com](https://supabase.com) → New Project
2. Choose region closest to your users
3. Save your project password

### 1.2 Get Database Credentials
Navigate to **Settings → Database** and note:
- **Host**: `db.<project-ref>.supabase.co`
- **Port**: `5432` (direct) or `6543` (connection pooler)
- **Database**: `postgres`
- **User**: `postgres`
- **Password**: Your project password

### 1.3 Create Storage Bucket
1. Go to **Storage** in the Supabase dashboard
2. Click **New Bucket** → Name it `media`
3. Set the bucket to **Public** (for book covers and admin photos)
4. Under **Policies**, add a policy allowing public reads:
   - **SELECT** for `authenticated` and `anon` roles

### 1.4 Get Storage Credentials
Navigate to **Settings → API**:
- **Project URL**: `https://<project-ref>.supabase.co`
- **Service Role Key**: Copy the `service_role` key (keep secret!)

Storage S3 endpoint: `https://<project-ref>.supabase.co/storage/v1/s3`
Public URL pattern: `https://<project-ref>.supabase.co/storage/v1/object/public/media`

---

## Step 2: Koyeb Deployment

### 2.1 Create Service
1. Go to [koyeb.com](https://koyeb.com) → Create Service
2. Deploy from **GitHub** → Select `Jarreva-Creative` repository
3. Choose **Docker** as the builder (the Dockerfile will be auto-detected)
4. Set the exposed port to `8000`

### 2.2 Set Environment Variables

Add these in the Koyeb dashboard under **Service → Settings → Environment Variables**:

```env
# Application
APP_NAME=Jarreva Creative
APP_ENV=production
APP_KEY=                              # php artisan key:generate --show
APP_DEBUG=false
APP_URL=https://your-app.koyeb.app

# Database (Supabase PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=db.<project-ref>.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=<supabase-project-password>
DB_SSLMODE=require

# Session, Cache & Queue (must use database — Koyeb is ephemeral)
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_SECURE_COOKIE=true
CACHE_STORE=database
QUEUE_CONNECTION=database

# Logging
LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=error

# Mail (Gmail SMTP)
MAIL_MAILER=smtp
MAIL_SCHEME=smtps
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=jarrevacreative@gmail.com
MAIL_PASSWORD=<gmail-app-password>
MAIL_FROM_ADDRESS=jarrevacreative@gmail.com
MAIL_FROM_NAME=Jarreva Creative

# CDN (Cloudflare Pages)
ASSET_CDN_ENABLED=true
ASSET_CDN_URL=https://jarreva-frontend-assets.pages.dev

# Supabase Storage (S3-compatible)
SUPABASE_STORAGE_URL=https://<project-ref>.supabase.co/storage/v1/s3
SUPABASE_STORAGE_KEY=<supabase-service-role-key>
SUPABASE_STORAGE_SECRET=<supabase-service-role-key>
SUPABASE_STORAGE_BUCKET=media
SUPABASE_STORAGE_REGION=auto
SUPABASE_STORAGE_PUBLIC_URL=https://<project-ref>.supabase.co/storage/v1/object/public/media

# Security
BCRYPT_ROUNDS=12

# Server Port
PORT=8000
```

### 2.3 Deploy
Push to GitHub → Koyeb auto-builds and deploys:
1. Docker builds the image (PHP 8.3, Node 22, Composer, Vite)
2. `start.sh` runs at container start:
   - `php artisan migrate --force`
   - `php artisan config:cache`
   - `php artisan storage:link`
   - `php artisan queue:work` (background)
   - `php artisan serve --port=8000`

### 2.4 Seed Admin Users
After first deployment, use Koyeb's **Exec** feature (or run a one-time command):
```bash
php artisan db:seed --force
```

---

## Step 3: Verification

| Test | URL | Expected |
|---|---|---|
| Homepage | `https://your-app.koyeb.app/` | Landing page with 3D effects |
| Health Check | `https://your-app.koyeb.app/up` | `{"status":"ok"}` |
| Catalog | `https://your-app.koyeb.app/catalog` | Book listing |
| Admin Login | `https://your-app.koyeb.app/admin/login` | Login form |
| Admin Dashboard | `https://your-app.koyeb.app/admin/dashboard` | Stats dashboard |
| Contact Form | `https://your-app.koyeb.app/contact` | Form + email delivery |
| CDN Assets | Browser DevTools → Network | `pages.dev` URLs |
| Book Covers | Upload via admin | Stored in Supabase Storage |

---

## Step 4: CDN Assets Update

The CDN (`jarreva-frontend-assets`) is **independent** and requires no changes.

To deploy new frontend assets:
```bash
cd scripts/
./build-cdn.sh
cd ../jarreva-frontend-assets
git add . && git commit -m "Update assets" && git push
```

Cloudflare Pages auto-deploys on push.

---

## Architecture Details

### File Storage
- **Static assets** (CSS, JS, Images, Three.js) → Cloudflare Pages CDN
- **User uploads** (book covers, admin photos) → Supabase Storage (S3-compatible)
- **Sessions, cache, queue** → Supabase PostgreSQL (database driver)

### Asset URL Resolution
- `@cdn('path')` → Cloudflare Pages URL (static assets)
- `@storage_url($path)` → Supabase Storage URL in production, local `asset('storage/...')` in dev

### Key Files
| File | Purpose |
|---|---|
| `Dockerfile` | Production Docker build for Koyeb |
| `.dockerignore` | Excludes unnecessary files from Docker build |
| `start.sh` | Runtime startup (migrations, config cache, queue worker, serve) |
| `nixpacks.toml` | Legacy Nixpacks config (kept as reference) |
| `config/filesystems.php` | Defines `supabase` disk (S3-compatible) |
| `app/Helpers/StorageHelper.php` | Disk selection + URL generation helper |
| `app/Helpers/CdnHelper.php` | CDN URL helper for static assets |

---

## Troubleshooting

### Database connection refused
- Verify `DB_SSLMODE=require` is set
- Use port `5432` (direct) or `6543` (connection pooler)
- Check Supabase dashboard → Database → Connection string

### File uploads not working
- Verify Supabase Storage bucket `media` exists and is set to **public**
- Check `SUPABASE_STORAGE_URL`, `SUPABASE_STORAGE_KEY` env vars
- Ensure `league/flysystem-aws-s3-v3` is installed (`composer install`)

### Emails not sending
- Gmail requires an **App Password** (not your regular password)
- Go to Google Account → Security → 2-Step Verification → App passwords
- Use the generated 16-character password as `MAIL_PASSWORD`

### Assets not loading from CDN
- Check `ASSET_CDN_ENABLED=true` and `ASSET_CDN_URL` env vars
- Verify Cloudflare Pages deployment is current
- Check browser console for CORS errors (should be handled by `_headers` file)

### Container keeps restarting
- Check Koyeb logs for startup errors
- Verify `APP_KEY` is set (run `php artisan key:generate --show`)
- Ensure all required env vars are configured

---

## Cost Summary

| Service | Tier | Cost |
|---|---|---|
| Koyeb | Free (1 nano instance, 512MB) | $0/month |
| Supabase | Free (500MB DB, 1GB storage) | $0/month |
| Cloudflare Pages | Free (unlimited bandwidth) | $0/month |
| Gmail SMTP | Free (500 emails/day) | $0/month |
| **Total** | | **$0/month** |
