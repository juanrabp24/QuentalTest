FROM php:8.2-apache

# Instalación de dependencias necesarias para Symfony
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libzip-dev zip \
    && docker-php-ext-install intl pdo pdo_mysql zip \
    && a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf


# Establecer directorio de trabajo
WORKDIR /var/www/html
