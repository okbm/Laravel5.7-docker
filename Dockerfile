FROM php:7.3.2-fpm-alpine

RUN docker-php-ext-install pdo_mysql mysqli mbstring
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer