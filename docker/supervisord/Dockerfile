FROM php:7.4.8-fpm-alpine3.12

ENV PHPREDIS_VERSION 5.1.1

# Set working directory
WORKDIR /www

# Install dependencies
RUN apk --update add --no-cache \
    wget \
    bash \
    curl \
    git \
    build-base \
    libmemcached-dev \
    libmcrypt-dev \
    libxml2-dev \
    zlib-dev \
    autoconf \
    cyrus-sasl-dev \
    libgsasl-dev \
    supervisor \
    freetype \
    freetype-dev \
    libpng \
    libpng-dev \
    libjpeg-turbo \
    libjpeg-turbo-dev \
    libwebp \
    libwebp-dev \
    && docker-php-ext-configure gd \
        --with-gd \
        --with-freetype-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
        --with-png-dir=/usr/include/ \
        --with-webp-dir=/usr/include/ \
    && NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
    && docker-php-ext-install -j${NPROC} gd \
    && apk del --no-cache \
        libpng-dev \
        libwebp-dev \
        freetype-dev \
        libjpeg-turbo-dev


# Install extensions
RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install mysqli \
        mbstring \
        pdo \
        pdo_mysql \
        tokenizer \
        xml \
        redis

COPY ./docker/supervisord/supervisord.conf /etc/supervisord.conf
