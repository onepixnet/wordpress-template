ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm-alpine

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN set -eux && \
    apk update && \
    apk add git && \
    apk del && \
    rm -rf /var/lib/apt/lists/* && \
    mkdir /root/history && \
    chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions @composer exif gd mysqli zip && \
    ln -s composer /usr/local/bin/c && \
    curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
    chmod +x wp-cli.phar && \
    mv wp-cli.phar /usr/local/bin/wp

VOLUME /var/www/html
WORKDIR /var/www/html

#CMD ["echo", "\$PWD"]

CMD ["/bin/sh", "-c", "sh docker/php/install.sh && php-fpm"]