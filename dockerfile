# ---------- ETAPA 1: Frontend (pnpm) ----------
FROM node:20-alpine AS frontend-builder
WORKDIR /app

RUN corepack enable && corepack prepare pnpm@latest --activate

COPY package.json pnpm-lock.yaml ./
RUN pnpm install --frozen-lockfile

COPY resources ./resources
COPY public ./public
COPY vite.config.* ./
COPY tailwind.config.* ./
COPY postcss.config.* ./

RUN pnpm run build


# ---------- ETAPA 2: Vendor ----------
FROM composer:2 AS vendor
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --optimize-autoloader \
    --no-scripts


# ---------- ETAPA 3: PHP ----------
FROM php:8.2-cli-alpine
WORKDIR /app

RUN apk add --no-cache \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    oniguruma-dev \
    icu-dev

RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    zip \
    bcmath \
    intl \
    opcache

RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=16'; \
    echo 'opcache.max_accelerated_files=10000'; \
    echo 'opcache.validate_timestamps=0'; \
} > /usr/local/etc/php/conf.d/opcache.ini

# Copiar vendor
COPY --from=vendor /app/vendor ./vendor

# Copiar app completa
COPY . .

# Copiar build frontend
COPY --from=frontend-builder /app/public/build ./public/build

# Laravel fix
RUN rm -f public/hot && \
    mkdir -p storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

ENV APP_ENV=production \
    APP_DEBUG=false

EXPOSE 10000

CMD php artisan package:discover --ansi && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php -S 0.0.0.0:10000 -t public