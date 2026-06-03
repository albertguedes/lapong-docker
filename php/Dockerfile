#
# Dockerfile - PHP-FPM server image (Laravel)
#
# Usage:
#   docker build --build-arg PHP_VERSION=8.4 -t php-fpm-image .
#
# Supports: 8.2, 8.3, 8.4
#
ARG PHP_VERSION=8.4
FROM php:${PHP_VERSION}-fpm-alpine3.23

# hadolint ignore=DL3018,DL4006,SC3040
RUN apk add --no-cache \
    libpq-dev \
    postgresql-client \
    curl \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && curl -fsSL https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && COMPOSER_HOME=/usr/local/composer composer global require phpunit/phpunit:^11.0 --no-interaction --prefer-dist \
    && ln -sf /usr/local/composer/vendor/bin/phpunit /usr/local/bin/phpunit \
    && php /usr/local/bin/phpunit --version \
    && rm -rf /var/cache/apk/*

COPY php/phpunit.xml.dist /var/www/phpunit.xml.dist
COPY php/tests /var/www/tests
COPY src /var/www/html

RUN chown -R www-data:www-data /var/www

USER www-data
