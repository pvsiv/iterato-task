FROM php:8.3-fpm-alpine

RUN docker-php-ext-install pdo_mysql

ADD ./install-composer.sh /install-composer.sh
RUN sh /install-composer.sh

EXPOSE 9000

WORKDIR /var/www