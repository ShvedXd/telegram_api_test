FROM php:8.2-fpm

RUN apt update && apt install -y  \
        curl \
        wget \
        git \
        unzip \
        zip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmagickwand-dev \
        libmcrypt-dev \
        libonig-dev \
        postgresql-client-15 \
        libpng-dev \
        libwebp-dev \
        libicu-dev \
        libpq-dev \
        libxpm-dev \
        libvpx-dev \
        libwebp-dev \
        libzip-dev \
        libyaml-dev

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions @composer yaml xdebug imagick redis intl zip gd pgsql pdo_pgsql

RUN groupadd --gid 1000 user \
    && useradd --uid 1000 --gid 1000 --shell /usr/bin/fish user \
    && mkdir /home/user \
    && chmod 777 /home/user

USER user

WORKDIR /var/www

CMD ["php-fpm"]
