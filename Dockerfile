# Use the official PHP 8.1 image
FROM php:8.1-apache
WORKDIR /var/www/html
COPY ./app /var/www/html
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
