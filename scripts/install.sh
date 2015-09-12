#!/bin/bash
########################################
#                                      #
#  Install packages for Ubuntu 14.04   #
#                                      #
########################################

IS_INSTALLED=".installed"

# Setup Timezone
TIMEZONE="Asia/Taipei"

# Setup packages and version
PACKAGES_LIST="
apache2
curl
git
mysql-server
php5
php5-mysql
php5-xdebug
vim
"

PACKAGES=""
for package in $PACKAGES_LIST
do
    PACKAGES="$PACKAGES $package"
done

# is root?
if [ "`whoami`" != "root" ]; then
    echo "You may use root permission!"
    exit 1
fi

# set time zone
ln -sf /usr/share/zoneinfo/$TIMEZONE /etc/localtime

# update time
ntpdate time.stdtime.gov.tw

if [ ! -e $IS_INSTALLED ];then
    touch $IS_INSTALLED

    # update
    apt-get update -y

    export DEBIAN_FRONTEND=noninteractive
    debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password password'
    debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password password'

    # install packages
    apt-get install -y $PACKAGES

    # enable rewrite
    a2enmod rewrite
    sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

    # set MySQL password and domain
    mysql -uroot -ppassword -e 'USE mysql; UPDATE `user` SET `Host`="%" WHERE `User`="root" AND `Host`="localhost"; DELETE FROM `user` WHERE `Host` != "%" AND `User`="root"; FLUSH PRIVILEGES;'
    mysql -uroot -ppassword -e 'CREATE DATABASE `default` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci;'
    mysql -uroot -ppassword -e 'CREATE DATABASE `testing` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci;'

    # modified mysql config
    sed -i 's/127\.0\.0\.1/0\.0\.0\.0/g' /etc/mysql/my.cnf

    # modified php.ini
    sed -i "s/^;date.timezone =.*/date.timezone = $TIMEZONE/g" /etc/php5/apache2/php.ini

    # install composer
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
fi

# modified php.ini
sed -i "s/^error_reporting =.*/error_reporting = E_ALL \| E_STRICT/g" /etc/php5/apache2/php.ini
sed -i "s/^display_errors =.*/display_errors = On/g" /etc/php5/apache2/php.ini
sed -i "s/^display_startup_errors =.*/display_startup_errors = On/g" /etc/php5/apache2/php.ini

# modified nginx default site
echo "$DEFAULT_SITE" > "/etc/nginx/sites-available/default"

# restart services
service apache2 restart
service mysql restart
