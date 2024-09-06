FROM php:8.2-fpm-alpine

# Set the working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

# Install dependencies
RUN apk add --no-cache \
    build-base \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    zlib-dev \
    libzip-dev \
    vim \
    zip \
    unzip \
    curl \
    wget \
    git \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install gd pdo pdo_mysql bcmath zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer*.json /var/www/

# Install Composer dependencies (after copying the project)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN composer dump-autoload --optimize

COPY . /var/www

# Add user for laravel application
RUN addgroup -g 1000 www
RUN adduser -u 1000 -G www -s /bin/bash -D www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Set correct permissions for storage and bootstrap cache directories
RUN chown -R www:www /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]