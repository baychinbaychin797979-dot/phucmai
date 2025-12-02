FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    mysql-client \
    libpq-dev \
    libmcrypt-dev \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    opcache \
    && pecl install mcrypt-1.0.6 \
    && docker-php-ext-enable mcrypt

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install dependencies
RUN composer install --no-dev

# Expose port
EXPOSE 8000

# Run PHP built-in server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
