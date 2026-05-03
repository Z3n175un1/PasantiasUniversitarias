# --- ETAPA 1: Construcción de assets (Node.js) ---
FROM node:20-alpine AS frontend-builder
WORKDIR /app
COPY package*.json ./
RUN pnpm install
COPY . .
RUN pnpm run build

# --- ETAPA 2: Aplicación final (PHP) ---
FROM php:8.2-cli-alpine

# Instalar dependencias del sistema mínimas
RUN apk add --no-cache \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    oniguruma-dev \
    icu-dev

# Instalar extensiones PHP necesarias y OPcache para velocidad
RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    zip \
    bcmath \
    intl \
    opcache

# Configurar OPcache para máximo rendimiento
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=0'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Primero las dependencias de Composer para aprovechar el cache de Docker
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --optimize-autoloader

# Copiar el resto del código
COPY . .
RUN rm -f public/hot

# Copiar los assets ya compilados desde la etapa 1
COPY --from=frontend-builder /app/public/build ./public/build

# Permisos correctos
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Puerto de Render
EXPOSE 10000

# Comando de inicio: cacheamos todo para que la carga sea instantánea
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php -S 0.0.0.0:10000 -t public