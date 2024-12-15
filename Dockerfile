FROM php:8.4-cli

# Installs system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libjpeg-dev \
    libfreetype6-dev \
    libssl-dev \
    pkg-config \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Installs MongoDB PHP extension
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Installs Redis PHP extension
RUN pecl install redis \
    && docker-php-ext-enable redis


# Installs Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Sets working directory
WORKDIR /var/www/html

# Copies existing application code to working directory
COPY . .

# Installs Laravel dependencies
RUN composer install

# Sets permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Makes wait_for_mongo.sh executable
RUN chmod +x /var/www/html/wait_for_mongo.sh

# Expose port 8000 for Laravel development server
EXPOSE 8000
