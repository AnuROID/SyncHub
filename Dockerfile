FROM php:8.2-cli

# Install system dependencies + Node
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install frontend dependencies
RUN npm install

# Build Vite assets
RUN npm run build

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

RUN php artisan migrate --force
# Generate Laravel key if not exists
RUN php artisan key:generate || true

# Expose port
EXPOSE 10000

# Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=10000
