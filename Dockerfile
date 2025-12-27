FROM oven/bun:debian AS bun-source

FROM serversideup/php:8.4-fpm-nginx AS base

WORKDIR /var/www/html

ARG USER_ID
ARG GROUP_ID

USER root

RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID  && \
    docker-php-serversideup-set-file-permissions --owner $USER_ID:$GROUP_ID --service nginx

USER www-data

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY --from=bun-source /usr/local/bin/bun /usr/local/bin/bun
COPY --from=bun-source /usr/local/bin/bunx /usr/local/bin/bunx
COPY --chown=www-data . .

USER root

RUN chmod -R 775 /var/www/html/storage/logs \
    && chmod -R 775 /var/www/html/bootstrap/cache

COPY --chmod=755 entrypoint.d/ /etc/entrypoint.d/

USER www-data
