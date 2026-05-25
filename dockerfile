# ---------- ETAPA 1: Frontend ----------
FROM node:20-alpine AS frontend-builder

WORKDIR /app

# Activar pnpm
RUN corepack enable && corepack prepare pnpm@9.12.0 --activate

# Copiar todo el proyecto
COPY . .

# Instalar dependencias frontend
RUN pnpm install --no-frozen-lockfile

# Build Vite
RUN pnpm run build


# ---------- ETAPA 2: Composer ----------
FROM composer:2 AS vendor

WORKDIR /app

# Copiar proyecto completo
COPY . .

# Instalar dependencias PHP
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --optimize-autoloader


# ---------- ETAPA 3: PHP ----------
FROM php:8.2-cli-alpine

WORKDIR /app

# Dependencias del sistema
RUN apk add --no-cache \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    oniguruma-dev \
    icu-dev \
    unzip \
    git

# Extensiones PHP
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
    echo 'opcache.validate_timestamps=0'; \
} > /usr/local/etc/php/conf.d/opcache.ini

# Copiar aplicación
COPY . .

# Copiar vendor desde Composer
COPY --from=vendor /app/vendor ./vendor

# Copiar build frontend
COPY --from=frontend-builder /app/public/build ./public/build

# Crear carpetas Laravel
RUN mkdir -p storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Variables entorno
ENV APP_ENV=production
ENV APP_DEBUG=false

# Puerto Render
EXPOSE 10000

# Comando inicio
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]