FROM base
MAINTAINER MilesChou <jangconan@gmail.com>

RUN cd /opt && \
    curl -LOs https://files.phpmyadmin.net/phpMyAdmin/4.5.2/phpMyAdmin-4.5.2-all-languages.tar.gz && \
    tar xzf phpMyAdmin-4.5.2-all-languages.tar.gz && \
    mv phpMyAdmin-4.5.2-all-languages phpmyadmin && \
    rm -rf phpMyAdmin-4.5.2-all-languages.tar.gz && \
    rm -rf /var/www/html && \
    mv phpmyadmin /var/www/html

COPY config.inc.php ./config.inc.php
VOLUME ["/var/www/html"]
