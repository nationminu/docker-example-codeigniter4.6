# PHP 8.4.4
FROM php:8.4.4-apache

WORKDIR /var/www/html

ARG GID=2000
ARG UID=1001

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN apt-get update && apt-get install -y unzip wget git curl libicu-dev zlib1g-dev libzip-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip mysqli pdo_mysql intl gd \
    && a2enmod rewrite

# 로컬
RUN useradd -ms /bin/bash ghost
# 운영
# RUN groupadd -g ${GID} ghost && useradd -u ${UID} -g ghost -m -s /bin/bash ghost

USER ghost

ADD framework-4.6.1 /var/www/html/

COPY --from=composer /usr/bin/composer /usr/bin/composer

EXPOSE 80