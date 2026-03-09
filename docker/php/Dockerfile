FROM php:8.4-fpm-alpine

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

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

EXPOSE 8080
CMD ["sh", "-lc", "php artisan serve --host=0.0.0.0 --port=8080"]
