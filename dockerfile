# ---------- ETAPA 1: Frontend (pnpm) ----------
FROM node:20-alpine AS frontend-builder

WORKDIR /app

# Activar pnpm con versión fija (más estable en Render)
RUN corepack enable && corepack prepare pnpm@9.12.0 --activate

# Copiar archivos de dependencias
COPY package.json pnpm-lock.yaml ./

# Instalar dependencias
RUN pnpm install --frozen-lockfile

# Copiar archivos frontend
COPY resources ./resources
COPY public ./public
COPY vite.config.* ./
COPY tailwind.config.* ./
COPY postcss.config.* ./

# Build Vite
RUN pnpm run build


# ---------- ETAPA 2: Vendor ----------
FROM composer:2 AS vendor

WORKDIR /app

# Copiar archivos Composer
COPY composer.json composer.lock ./

# Instalar dependencias PHP
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

# Instalar dependencias del sistema
RUN apk add --no-cache \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    oniguruma-dev \
    icu-dev \
    unzip \
    git

# Instalar extensiones PHP
RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    zip \
    bcmath \
    intl \
    opcache

# Configuración OPcache
RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=16'; \
    echo 'opcache.max_accelerated_files=10000'; \
    echo 'opcache.validate_timestamps=1'; \
} > /usr/local/etc/php/conf.d/opcache.ini

# Copiar vendor desde etapa composer
COPY --from=vendor /app/vendor ./vendor

# Copiar aplicación completa
COPY . .

# Copiar build frontend
COPY --from=frontend-builder /app/public/build ./public/build

# Crear carpetas necesarias y permisos
RUN rm -f public/hot && \
    mkdir -p storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Variables por defecto
ENV APP_ENV=production
ENV APP_DEBUG=false

# Puerto Render
EXPOSE 10000

# Comando inicio
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]