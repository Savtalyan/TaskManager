# Use PHP-FPM as a base image
FROM php:8.2-fpm

# Install system dependencies for PHP extensions (MySQL, etc.)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libpng-dev \
    zip \
    git \
    libicu-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install gd zip intl pdo pdo_mysql \
    && apt-get clean

# Set ownership and permissions for Laravel's storage and cache

# Install Composer (for PHP package management)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/TaskManager

# Copy the app code to the container
COPY . .

# Expose the PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
RUN chmod +x ./entrypoint.sh
ENTRYPOINT ["./entrypoint.sh"]
CMD ["php-fpm"]
