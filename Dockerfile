FROM php:5.6-apache
MAINTAINER MilesChou <jangconan@gmail.com>

RUN apt-get update -y && apt-get install -y curl git zlib1g-dev && apt-get clean
RUN docker-php-ext-install zip mysql mysqli pdo_mysql mbstring
RUN a2enmod rewrite
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

COPY composer.json ./composer.json
COPY composer.lock ./composer.lock
RUN composer install --no-dev --optimize-autoloader

COPY conf/php.ini /usr/local/etc/php/
COPY application ./application
COPY public ./public
COPY .htaccess ./.htaccess
COPY index.php ./index.php
RUN chown www-data:www-data -R .

VOLUME ["/var/www/html/public/upload"]
