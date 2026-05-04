# ---------- ETAPA 1: Frontend (pnpm) ----------
FROM node:20-alpine AS frontend-builder
WORKDIR /app

# Activar pnpm correctamente
RUN corepack enable && corepack prepare pnpm@latest --activate

# Solo dependencias primero (mejor cache)
COPY package.json pnpm-lock.yaml ./
RUN pnpm install --frozen-lockfile

# Copiar solo lo necesario para build (evita invalidar cache)
COPY resources ./resources
COPY public ./public
COPY vite.config.* ./
COPY tailwind.config.* ./
COPY postcss.config.* ./

RUN pnpm run build


# ---------- ETAPA 2: Vendor (Composer optimizado) ----------
FROM composer:2 AS vendor
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --optimize-autoloader


# ---------- ETAPA 3: PHP runtime ----------
FROM php:8.2-cli-alpine

WORKDIR /app

# Instalar solo lo necesario (menos peso)
RUN apk add --no-cache \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    oniguruma-dev \
    icu-dev

# Extensiones PHP
RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    zip \
    bcmath \
    intl \
    opcache

# OPcache afinado para producción
RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=16'; \
    echo 'opcache.max_accelerated_files=10000'; \
    echo 'opcache.validate_timestamps=0'; \
    echo 'opcache.jit=tracing'; \
    echo 'opcache.jit_buffer_size=64M'; \
} > /usr/local/etc/php/conf.d/opcache.ini

# Copiar vendor ya optimizado
COPY --from=vendor /app/vendor ./vendor

# Copiar app (sin node_modules ni basura si usas .dockerignore)
COPY . .

# Copiar assets compilados
COPY --from=frontend-builder /app/public/build ./public/build

# Limpieza Laravel
RUN rm -f public/hot

# Permisos seguros
RUN mkdir -p storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Variables recomendadas
ENV APP_ENV=production \
    APP_DEBUG=false

EXPOSE 10000

# Startup más robusto
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php -S 0.0.0.0:10000 -t public