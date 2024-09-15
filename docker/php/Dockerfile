FROM php:8.3.11-fpm-bookworm

ENV PHPREDIS_VERSION 5.3.7

# Set working directory
WORKDIR /www

# Install dependencies
RUN apt-get update -qq && apt-get install -y --no-install-recommends \
    openssh-client \
    iputils-ping \
    libgd-dev \
    # For PHP mbstring package
    libonig-dev \
    zip \
    libzip-dev \
    libfreetype6-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    unixodbc \
    unixodbc-dev \
    build-essential \
    locales \
    vim \
    nano \
    unzip \
    git \
    curl \
    gnupg2 \
    apt-transport-https \
    procps \
    supervisor \
    && apt-get update -qq \
    # Get PHP dependencies
    && pecl install \
        xhprof-2.2.0 \
    && mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    # Configure PHP dependencies
    &&  docker-php-ext-configure gd \
        --enable-gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
        --with-webp=/usr/include/ \
    # Install and enable PHP dependencies
    && docker-php-ext-install \
        gd \
        pdo_mysql \
        mbstring \
        zip \
        exif \
        pcntl \
        bcmath \
        redis \
        sockets \
        opcache \
    && docker-php-ext-enable \
        xhprof \
        opcache \
    # Cleanup
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install Composer
ENV COMPOSER_VERSION 2.1.9

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer \
    --version=$COMPOSER_VERSION

RUN chown www-data:www-data -R /var/www

USER www-data

VOLUME ["/www"]

# Expose port 9000 and start php-fpm server
EXPOSE 9000
