FROM node:20-alpine AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


FROM php:8.4-cli-alpine

RUN apk add --no-cache \
    bash git unzip \
    icu-dev icu-libs \
    libzip-dev zlib-dev \
    postgresql-dev \
    oniguruma-dev \
    linux-headers \
    $PHPIZE_DEPS

RUN docker-php-ext-install -j"$(nproc)" \
    intl opcache pdo pdo_pgsql zip

RUN pecl install redis \
 && docker-php-ext-enable redis

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www

COPY . /var/www
RUN rm -f public/hot
COPY --from=frontend /app/public/build /var/www/public/build

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p storage/logs bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache || true

EXPOSE 8080
CMD ["sh", "-lc", "php artisan serve --host=0.0.0.0 --port=8080"]
