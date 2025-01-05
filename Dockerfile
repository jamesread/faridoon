FROM docker.io/php:8.3-apache AS base

RUN apt-get update && apt-get install unzip -y --no-install-recommends && rm -rf /var/lib/apt/lists/*

COPY --from=docker.io/composer:2 /usr/bin/composer /usr/bin/composer

RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf
RUN a2enmod rewrite

RUN docker-php-ext-configure pdo_mysql \
 && docker-php-ext-install pdo_mysql \
 && docker-php-ext-enable pdo_mysql

EXPOSE 8080

COPY src/ /var/faridoon/src/
COPY composer.json /var/faridoon/

WORKDIR /var/faridoon/

RUN composer install --no-dev --no-suggest
RUN rm -rf /var/www/html && ln -s /var/faridoon/src/ /var/www/html

#COPY config.dist.ini /config/config.ini

VOLUME ["/config"]

USER www-data

