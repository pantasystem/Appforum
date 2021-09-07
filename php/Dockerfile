FROM php:7.4-fpm
COPY php.ini /usr/local/etc/php/
RUN apt-get update \
    && apt-get install -y zlib1g-dev libzip-dev mariadb-client \
    && docker-php-ext-install zip pdo_mysql

RUN apt-get install -y graphviz

COPY --from=composer:1.8.6 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

ENV PATH $PATH:/usr/bin/composer
WORKDIR /var/www/html
