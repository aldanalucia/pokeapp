FROM php:8.2-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev zip unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo

WORKDIR /var/www
COPY . /var/www

RUN composer install

EXPOSE 8000

RUN php artisan key:generate --ansi
CMD php artisan serve --host=0.0.0.0 --port=8000
