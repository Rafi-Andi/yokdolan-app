# Stage 1: Build Backend (Laravel Composer Dependencies)
FROM composer:2 AS backend_builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs --no-scripts

# Stage 2: Build Frontend (Vue/Vite)
FROM php:8.2-cli AS frontend_builder
WORKDIR /app

# Install Node.js 22 (Vite membutuhkan Node >= 20.19)
RUN apt-get update && apt-get install -y curl \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy seluruh file project untuk keperluan build frontend
COPY . .

# Copy vendor dari tahap pertama (karena Vite plugin Wayfinder menjalankan command artisan yang butuh PHP & Vendor)
COPY --from=backend_builder /app/vendor ./vendor

# Install NPM dependencies & jalankan build
RUN npm ci && npm run build

# Stage 3: Production Image (Apache + PHP 8.2)
FROM php:8.2-apache

# Install system dependencies dan PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Aktifkan Apache mod_rewrite untuk routing Laravel
RUN a2enmod rewrite

# Ubah Apache DocumentRoot agar mengarah ke folder public/ Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

# Copy seluruh file project
COPY . .

# Copy vendor dari backend_builder
COPY --from=backend_builder /app/vendor ./vendor

# Copy file build frontend dari frontend_builder
COPY --from=frontend_builder /app/public/build ./public/build

# Pindahkan aset YokDolan & jalankan storage:link
RUN mkdir -p storage/app/public/ \
    && cp -r public/channels storage/app/public/ 2>/dev/null || true \
    && cp -r public/rewards storage/app/public/ 2>/dev/null || true \
    && cp -r public/missions storage/app/public/ 2>/dev/null || true \
    && php artisan storage:link || true

# Atur permission yang sesuai agar Apache (www-data) bisa menulis di folder storage & bootstrap/cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Port 80 akan digunakan di dalam container (NPM akan meneruskan traffic ke port ini)
EXPOSE 80
