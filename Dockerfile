# Use the official PHP image as the base image
FROM php:7.4-apache

# Install necessary extensions and libraries for the PHP app
RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install mysqli


# Copy the PHP app files into the container's /var/www/html directory
COPY . /var/www/html

# Expose port 80 for the Apache web server
EXPOSE 80
