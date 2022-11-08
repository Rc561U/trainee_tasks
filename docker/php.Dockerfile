FROM php:8.1-fpm
USER root

RUN apt-get update && \
    apt-get install -y git zip

RUN curl --silent --show-error https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install exif

RUN apt-get install libcurl4-gnutls-dev

# OAuth
RUN apt-get install -y libpcre3-dev && pecl install oauth \
    && echo "extension=oauth.so" > /usr/local/etc/php/conf.d/docker-php-ext-oauth.ini



