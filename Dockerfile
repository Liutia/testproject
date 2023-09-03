# Use the official PHP 8.1 image
FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Copy your PHP application files to the container
COPY ./app /var/www/html

# Install any PHP extensions your application requires (e.g., mysqli)
RUN docker-php-ext-install mysqli
