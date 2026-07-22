FROM php:8.4-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
  git unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev \
  && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy project
COPY . .

# Install Composer packages
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Create Laravel storage directories
RUN mkdir -p storage/framework/cache \
  storage/framework/sessions \
  storage/framework/views \
  storage/logs \
  bootstrap/cache

# Give permissions
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=${PORT:-10000}