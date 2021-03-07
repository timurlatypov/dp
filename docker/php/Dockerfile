FROM php:7.4.9-fpm

ENV PHPREDIS_VERSION 5.1.1

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
    librabbitmq-dev \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/ubuntu/18.04/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update -qq \
    # Get PHP dependencies
    && ACCEPT_EULA=Y apt-get install msodbcsql17 \
    && pecl install \
        sqlsrv-5.8.0 \
        pdo_sqlsrv-5.8.0 \
        xdebug-2.9.2 \
        xhprof-2.2.0 \
        amqp-1.10.2 \
    && mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    # Configure PHP dependencies
    &&  docker-php-ext-configure gd \
        --enable-gd \
        --with-freetype=/usr/include/ \
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
        sqlsrv \
        pdo_sqlsrv \
        xdebug \
        xhprof \
        amqp \
        opcache \
    # Cleanupg
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install Composer
ENV COMPOSER_VERSION 2.0.5

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer \
    --version=$COMPOSER_VERSION

USER www-data

VOLUME ["/www"]

# Expose port 9000 and start php-fpm server
EXPOSE 9000
