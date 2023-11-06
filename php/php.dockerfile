# php.dockerfile - a dockerfile to create a php-fpm server image.
#
# created: 2023-06-11
# author: albert r. carnier guedes (albert@teko.net.br)
# 
# Distributed under the MIT License. See LICENSE for more information.
#
FROM php:8.1.19-fpm-alpine3.17

# Instale as dependências necessárias
RUN apk update \
    && apk add --no-cache postgresql-dev

# Install php modules to php-pgsql.
RUN apk add --no-cache libpq-dev

# Instale as extensões PHP necessárias
RUN docker-php-ext-install pdo_pgsql pgsql

# Install npm
RUN apk add --update nodejs npm

# Download and install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

WORKDIR /var/www/html