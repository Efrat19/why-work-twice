FROM php:7
MAINTAINER Efrat C. Levitan <efrat890089@gmail.com>

RUN apt-get update -y && apt-get install -y openssl zip unzip git vim cron
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring bcmath

RUN echo "* * * * * cd /app && php artisan schedule:run >> /dev/null 2>&1" >> /etc/crontab

WORKDIR /app
COPY . /app
RUN composer install
CMD service cron start && php artisan serve --host=0.0.0.0
EXPOSE 8000
