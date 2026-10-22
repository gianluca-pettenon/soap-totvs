FROM phpdockerio/php:8.5-fpm
WORKDIR "/app"

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php8.5-memcached \
        php8.5-soap \
        php8.5-xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD ["sh", "-lc", "composer install && /usr/sbin/php-fpm8.5 -F"]
