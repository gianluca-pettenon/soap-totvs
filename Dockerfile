FROM phpdockerio/php:8.2-fpm
WORKDIR "/App"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php8.2-memcached \ 
        php8.2-soap \ 
        php8.2-xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer