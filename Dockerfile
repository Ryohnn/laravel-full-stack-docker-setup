FROM oven/bun:debian AS bun-source

FROM serversideup/php:8.4-fpm-nginx AS base

WORKDIR /var/www/html

COPY --from=bun-source /usr/local/bin/bun /usr/local/bin/bun
COPY --from=bun-source /usr/local/bin/bunx /usr/local/bin/bunx
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock package.json ./

RUN composer install --no-scripts --prefer-dist --no-cache
RUN bun install

COPY . .

USER root

RUN composer dump-autoload --optimize \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

USER www-data
