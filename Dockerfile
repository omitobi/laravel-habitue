# Set master image
# FROM php:7.2-fpm-alpine
FROM php:8.0-fpm-alpine

# Copy composer.lock and composer.json
COPY composer.json /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install Additional dependencies
RUN apk update && apk add --no-cache \
    build-base shadow vim curl \
    php8 \
    php8-fpm \
    php8-common \
    php8-mbstring \
    php8-xml \
    php8-openssl \
    php8-json \
    php8-phar \
    php8-zip \
    php8-gd \
    php8-dom \
    php8-session \
    php8-zlib

# Add and Enable PHP-PDO Extenstions

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN rm -rf /var/cache/apk/*

## Add UID '1000' to www-data
#RUN usermod -u 1000 www-data
#
## Copy existing application directory permissions
#COPY --chown=www-data:www-data . /var/www/html
#
## Change current user to www
#USER www-data
#
## Expose port 9000 and start php-fpm server
#EXPOSE 9000
#CMD ["php-fpm"]