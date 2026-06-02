# ============================================================
# Jarreva Creative — Production Dockerfile (Koyeb)
# ============================================================
# Multi-stage build for Laravel 12 + Vite + PostgreSQL
# ============================================================

FROM php:8.3-cli AS base

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    ca-certificates \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_pgsql \
        pgsql \
        mbstring \
        xml \
        curl \
        bcmath \
        zip \
        gd \
        opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configure OPcache for production
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Node.js 22.x
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Set workdir
WORKDIR /app

# ---- Dependency stage ----
# Copy dependency files first for better Docker layer caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

COPY package.json package-lock.json ./
RUN npm ci --omit=dev

# ---- Application stage ----
COPY . .

# Run post-install Composer scripts (needs full source)
RUN composer run-script post-autoload-dump --no-interaction

# Build frontend assets (Vite + Tailwind)
RUN npm run build

# Cache routes and views (config:cache runs at runtime in start.sh)
RUN php artisan route:cache \
    && php artisan view:cache

# Ensure storage directories exist with correct permissions
RUN mkdir -p storage/framework/{sessions,views,cache/data} \
    && mkdir -p storage/logs \
    && mkdir -p storage/app/public \
    && chmod -R 775 storage bootstrap/cache

# Make start script executable
RUN chmod +x start.sh

# Expose port (Koyeb default)
EXPOSE 8000

# Start the application
CMD ["bash", "start.sh"]
