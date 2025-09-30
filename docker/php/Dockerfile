FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www