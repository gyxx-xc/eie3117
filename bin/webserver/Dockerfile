# from https://www.makbeta.com/blog/configuring-apachephpcomposer-docker-image

# start with the official Composer image and name it
FROM composer:latest AS composer
ENV COMPOSER_ALLOW_SUPERUSER 1
# Use an official PHP and Apache base image
FROM php:8.2-apache AS php-apache
ENV HOSTNAME php-apache
RUN a2enmod rewrite

# Expose port 80 for Apache
EXPOSE 80
# Start Apache in the foreground
CMD ["apache2-foreground"]

# copy the Composer PHAR from the Composer image into the PHP image
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git
RUN docker-php-ext-install pdo pdo_mysql
