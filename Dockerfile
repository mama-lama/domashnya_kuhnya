# Get wkhtmltopdf binary
FROM surnet/alpine-wkhtmltopdf:3.20.0-0.12.6-full AS wkhtmltopdf_bin

FROM php:8.4-fpm-alpine

# Install system dependencies and php extensions
RUN apk add --no-cache \
    zip \
    libzip-dev \
    unzip \
    git \
    mysql-client \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    libstdc++ \
    libx11 \
    libxrender \
    libxext \
    fontconfig \
    font-noto \
    python3 \
    weasyprint \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql zip gd

# Copy wkhtmltopdf binaries from the surnet image
COPY --from=wkhtmltopdf_bin /bin/wkhtmltopdf /usr/bin/wkhtmltopdf
COPY --from=wkhtmltopdf_bin /bin/libwkhtmltox.so* /usr/lib/

# Raise upload limits to match nginx client_max_body_size (20m)
RUN { \
    echo 'upload_max_filesize = 20M'; \
    echo 'post_max_size = 25M'; \
    } > /usr/local/etc/php/conf.d/uploads.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . /var/www

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["/usr/local/bin/entrypoint.sh"]
