FROM php:8.3.11-fpm

RUN apt-get update; apt-get install -y apt-utils zip vim telnet git iputils-ping net-tools iproute2 ncat

#extention installer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

RUN install-php-extensions gd opcache zip pdo_mysql mysqli gmp bcmath intl exif xdebug APCu memcached redis mongodb sockets @composer

RUN echo '\
 xdebug.mode=develop,debug \n\
 xdebug.client_port=9001 \n\
 xdebug.client_host=172.22.1.1 \n\
 xdebug.var_display_max_children=-1 \n\
 xdebug.var_display_max_data=-1 \n\
 xdebug.var_display_max_depth=-1 \n\
' >> $(php --ini | grep xdebug | awk 'BEGIN {FS="," }; {print $1}')

WORKDIR /app

