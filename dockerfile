FROM php:8.2-cli

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear app
WORKDIR /app
COPY . .

# Instalar dependencias Laravel
RUN composer install --no-dev --optimize-autoloader

# Permisos
RUN chmod -R 775 storage bootstrap/cache

# Exponer puerto
EXPOSE 10000

# Correr php artisan

RUN php artisan migrate --force

# Comando de inicio
CMD php -S 0.0.0.0:10000 -t public

# Rapidez al momento de ejecutar el proyecto

RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache