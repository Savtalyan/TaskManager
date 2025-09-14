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
    netcat-openbsd \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip intl pdo pdo_mysql \
    && apt-get install -y curl gnupg && \
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer (for PHP package management)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/TaskManager

# Copy the app code
COPY . .

# Set ownership and permissions for Laravel's storage and cache
RUN chown -R www-data:www-data /var/www/TaskManager/storage /var/www/TaskManager/bootstrap/cache
RUN chmod -R 775 /var/www/TaskManager/storage /var/www/TaskManager/bootstrap/cache

# Make entrypoint executable
RUN chmod +x ./entrypoint.sh

# Expose the PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
ENTRYPOINT ["./entrypoint.sh"]
CMD ["php-fpm"]
