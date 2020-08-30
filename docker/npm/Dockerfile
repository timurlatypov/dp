FROM amd64/node:12.14.1-alpine

RUN apk add --no-cache wget \
    bash \
    curl \
    git \
    build-base \
    zlib-dev \
    libtool \
    autoconf \
    automake \
    libpng-dev \
    libc6-compat \
    libjpeg-turbo-dev \
    nasm \
    python3 \
    && rm -rf /var/cache/apk/*

WORKDIR /www
