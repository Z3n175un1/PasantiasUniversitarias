FROM php:8.2-cli

# Instalar dependencias del sistema + Node
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev zip libzip-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear app
WORKDIR /app
COPY . .

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Instalar frontend
RUN npm install && npm run build

# Permisos
RUN chmod -R 775 storage bootstrap/cache

# Exponer puerto
EXPOSE 10000

# Comando de inicio
CMD php artisan config:clear && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php -S 0.0.0.0:10000 -t public