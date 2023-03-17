ARG PHP_VERSION=8.0-apache
ARG NODE_VERSION=14.15-alpine3.13

FROM php:${PHP_VERSION} as php_laravel
# install dependencies for laravel 8
RUN apt-get update && apt-get install -y \
  curl \
  git \
  libicu-dev \
  libpq-dev \
  libmcrypt-dev \
  mariadb-client \
  openssl \
  unzip \
  vim \
  zip \
  zlib1g-dev \
  libpng-dev \
  libzip-dev && \
rm -r /var/lib/apt/lists/*
# install extension for laravel 8
RUN pecl install mcrypt-1.0.4 && \
  docker-php-ext-install fileinfo exif pcntl bcmath gd mysqli pdo_mysql && \
  docker-php-ext-enable mcrypt && \
  a2enmod rewrite
# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

ENV APP_SOURCE /var/www/php

# Set working directory
WORKDIR $APP_SOURCE
# set DocumentRoot to lavavel framework uploaded
RUN sed -i "s|DocumentRoot /var/www/html|DocumentRoot ${APP_SOURCE}/public|g" /etc/apache2/sites-enabled/000-default.conf

COPY .docker/apache2-foreground .docker/apache2-foreground
CMD [".docker/apache2-foreground"]


FROM node:$NODE_VERSION as laramix_build

WORKDIR /var/www/php
COPY . .
RUN npm install -q && \
    npm run-script prod

FROM php_laravel as executeable
ENV APP_SOURCE /var/www/php
ENV APP_DEBUG=false
ENV APP_URL=""
ENV APP_ENV=production
ENV DB_CONNECTION=mysql
ENV DB_HOST=localhost
ENV DB_PORT=3306
ENV DB_DATABASE=laravel
ENV DB_USERNAME=laravel
ENV DB_PASSWORD=laravel


# copy source laravel
COPY . .
COPY --from=laramix_build /var/www/php/public/css public/css
COPY --from=laramix_build /var/www/php/public/fonts public/fonts
COPY --from=laramix_build /var/www/php/public/js public/js

# give full access
RUN mkdir -p public/storage && \
    chmod -R 777 storage/* && \
    chmod -R 777 public/storage && \
    chmod -R 777 .docker/*
# install dependency laravel
RUN php -r "file_exists('.env') || copy('.env.example', '.env');" && \
    composer install --no-interaction --optimize-autoloader --no-dev && \
    php artisan package:discover --ansi && \
    php artisan key:generate --ansi --force && \
    php artisan optimize

VOLUME ${APP_SOURCE}/storage
# expose port default 80
EXPOSE 80/tcp
