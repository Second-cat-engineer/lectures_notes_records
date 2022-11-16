FROM php:8.0-apache

RUN apt-get update && apt-get install -y \
        cron \
        rsyslog \
        curl \
        wget \
        git \
        jq \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libxslt-dev \
        libicu-dev \
        libmcrypt-dev \
        libxml2-dev \
        libsodium-dev \
        zlib1g-dev \
        libpcre3-dev \
        libcurl4-openssl-dev \
        pkg-config \
        libssl-dev \
    && a2enmod \
        rewrite \
    && ACCEPT_EULA=Y \
        DEBIAN_FRONTEND=noninteractive \
        apt-get install --yes \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure \
        gd \
    && docker-php-ext-install \
        gd \
        mysqli \
        pdo_mysql

#Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

#Php.ini
ADD php.ini /usr/local/etc/php

