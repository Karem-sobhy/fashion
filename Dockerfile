FROM composer:latest as build
COPY . /app/
#production mode
# RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction
#staging mode
RUN composer install --prefer-dist --optimize-autoloader --no-interaction

FROM php:8.1.12-apache as production

RUN docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install pdo pdo_mysql
COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

COPY --from=build /app /var/www/html
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .env /var/www/html/.env

RUN a2enmod headers rewrite remoteip ;\
    {\
    echo RemoteIPHeader X-Real-IP ;\
    echo RemoteIPTrustedProxy 10.0.0.0/8 ;\
    echo RemoteIPTrustedProxy 172.16.0.0/12 ;\
    echo RemoteIPTrustedProxy 192.168.0.0/16 ;\
    } > /etc/apache2/conf-available/remoteip.conf;\
    a2enconf remoteip

RUN php artisan key:generate && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    chmod 777 -R /var/www/html/storage/ && \
    chmod 777 -R /var/www/html/public/assets/ && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite
