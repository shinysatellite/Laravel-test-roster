# Use the official PHP 8.2 image
FROM php:8.2

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update \
    && apt-get install -y libpng-dev libzip-dev zlib1g-dev \
    && apt-get install -y sqlite3 libsqlite3-dev \
    && docker-php-ext-install gd \
    && docker-php-ext-install exif \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo pdo_sqlite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files
COPY . .

# Create database directory
RUN touch /var/www/html/database/database.sqlite

# Install PHP dependencies
RUN composer install --no-interaction

# Expose port
EXPOSE 8000

# Command to run the application
CMD php artisan serve --host=0.0.0.0 --port=8000
