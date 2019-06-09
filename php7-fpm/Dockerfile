# See https://github.com/docker-library/php/blob/68f7e2d97abd53be373c925c2f040b2db2439d01/7.1/alpine3.9/fpm/Dockerfile
FROM php:7.3.6-fpm-alpine3.9

ARG TIMEZONE

MAINTAINER Guillaume CAOUISSIN <guillaume.caouissin@gmail.com>

RUN apk add \
    git \
    unzip

RUN docker-php-ext-install \
        sockets \
        pdo \
        pdo_mysql
		
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer --version

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
&& printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
&& "date"

COPY php-fpm.d /usr/local/etc/php-fpm.d/

WORKDIR /var/www/symfony