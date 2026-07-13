#!/bin/sh
set -eu

mkdir -p /var/www/storage/logs \
    /var/www/storage/framework/cache \
    /var/www/storage/framework/sessions \
    /var/www/storage/framework/views \
    /var/www/bootstrap/cache

touch /var/www/storage/logs/laravel.log

chmod -R 0777 /var/www/storage /var/www/bootstrap/cache
chmod 0666 /var/www/storage/logs/laravel.log

exec php-fpm
