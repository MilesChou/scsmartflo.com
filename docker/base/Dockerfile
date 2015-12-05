FROM php:5.6-apache
MAINTAINER MilesChou <jangconan@gmail.com>

RUN apt-get update -y && apt-get install -y curl git zlib1g-dev && apt-get clean
RUN docker-php-ext-install zip mysql mysqli pdo_mysql mbstring
RUN a2enmod rewrite
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
