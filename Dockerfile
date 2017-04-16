FROM php

RUN apt-get -y -qq -o=Dpkg::Use-Pty=0 update \
 && apt-get install -y -qq -o=Dpkg::Use-Pty=0 git curl unzip ant default-jdk phploc pdepend phpcpd phpdox phpunit phpmd php-codesniffer phing apt-utils \
 && pecl install -o -f xdebug \
 && echo "zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20160303/xdebug.so" > /usr/local/etc/php/conf.d/xdebug.ini \
 && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
