FROM php:7.4.8-fpm-buster

ENV PHPREDIS_VERSION 5.1.1

# Set working directory
WORKDIR /www

# Install dependencies
RUN apt-get update -qq && apt-get install -y --no-install-recommends \
    openssh-client \
    iputils-ping \
    libonig-dev \
    libgd-dev \
    libjpeg-dev \
    libpng-dev \
    libxpm-dev \
    libvpx-dev \
    zip \
    libzip-dev \
    libfreetype6-dev \
    unixodbc \
    unixodbc-dev \
    build-essential \
    libjpeg62-turbo-dev \
    locales \
    jpegoptim optipng pngquant gifsicle \
    vim \
    nano \
    unzip \
    git \
    curl \
    gnupg2 \
    apt-transport-https \
    libwebp-dev \
    ffmpeg \
    supervisor \
    && apt-get update -qq \
    # get php dependencies
    && pecl install xdebug-2.9.2 \
    && mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    # install and enable php dependencies
    && docker-php-ext-install \
        gd \
        pdo_mysql \
        mbstring \
        zip \
        exif \
        pcntl \
        bcmath \
        redis \
    && docker-php-ext-enable xdebug \
    # install composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    # install node/npm
    && curl -sL https://deb.nodesource.com/setup_14.x -o nodesource_setup.sh \
    && bash nodesource_setup.sh \
    && apt-get install -y nodejs \
    && curl -L https://www.npmjs.com/install.sh | sh \
    # cleanup
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Expose port 9000 and start php-fpm server
EXPOSE 9000
