FROM php:7.4-fpm-alpine

USER root

RUN apk update && apk add \
    build-base \
    vim
    
        
RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


EXPOSE 9000

