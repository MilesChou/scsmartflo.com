FROM php:5.6-apache
MAINTAINER MilesChou <jangconan@gmail.com>

RUN set -xe && \
        apt-get update -y && apt-get install -y \
            curl \
            git \
            zlib1g-dev
        && apt-get clean && rm -r /var/lib/apt/lists/*
RUN docker-php-ext-install zip mysql mysqli pdo_mysql mbstring
RUN a2enmod rewrite

# Install Composer
RUN set -xe && \
        curl -o composer-setup.php https://getcomposer.org/installer \
        && curl -o composer-setup.sig https://composer.github.io/installer.sig \
        && php -r "if (hash('SHA384', file_get_contents('composer-setup.php')) !== trim(file_get_contents('composer-setup.sig'))) { unlink('composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
        && php composer-setup.php \
        && php -r "unlink('composer-setup.php');" \
        &&  mv composer.phar /usr/local/bin/composer

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
