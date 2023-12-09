FROM php:8.1.0-apache as php

WORKDIR /var/www/html

# Mod Rewrite
RUN a2enmod rewrite

# Linux Libraries
RUN apt-get update -y && apt-get install -y \
    unzip zip \
    libpq-dev \
    libcurl4-gnutls-dev \
    libicu-dev \
    libmariadb-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    zlib1g-dev \
    netcat-openbsd

# Composer
COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

# PHP Extention
RUN docker-php-ext-install pdo pdo_mysql bcmath gettext intl gd

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

ENV PORT=8000
ENTRYPOINT ["docker/entrypoint.sh"]
