FROM php:8.1-fpm

RUN apt-get update && \
    apt-get install -y --no-install-recommends libpcre3-dev libssl-dev zlib1g-dev curl git unzip libxml2-dev libpq-dev libzip-dev openssl acl librabbitmq-dev libonig-dev

RUN docker-php-ext-install -j$(nproc) zip opcache intl pdo pdo_mysql && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN apt-get update &&\
    apt-get install --no-install-recommends --assume-yes --quiet ca-certificates curl git &&\
    rm -rf /var/lib/apt/lists/*

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/eliot

EXPOSE 9000