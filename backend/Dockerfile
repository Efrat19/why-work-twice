FROM prooph/php:7.2-zts

# Environmental Variables
ENV COMPOSER_HOME /root/composer
ENV COMPOSER_VERSION master

RUN apk add --no-cache --virtual .persistent-deps \
    git \
    unzip

RUN set -xe \
    && docker-php-ext-install \
        zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require hirak/prestissimo
FROM prooph/php:7.2-zts

# Environmental Variables
ENV COMPOSER_HOME /root/composer
ENV COMPOSER_VERSION master

RUN apk add --no-cache --virtual .persistent-deps \
    git \
    unzip

RUN set -xe \
    && docker-php-ext-install \
        zip \
WORKDIR /app
RUN composer install

CMD php artisan serve --host=0.0.0.0
EXPOSE 8000
