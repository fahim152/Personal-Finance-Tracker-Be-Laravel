# Use the official PHP image with Apache
FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    libzip-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www

# Remove default server definition
RUN rm /etc/apache2/sites-available/000-default.conf
RUN rm /etc/apache2/sites-enabled/000-default.conf

# Apache vhost
COPY ./docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN ln -s /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source
COPY . /var/www

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port 80
EXPOSE 80
