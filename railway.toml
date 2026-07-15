FROM php:8.4-fpm

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN apt-get update && apt-get install -y nodejs npm && apt-get clean

WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN npm ci && npm run build
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=$PORT