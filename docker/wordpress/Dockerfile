ARG WORDPRESS_VERSION
ARG PHP_VERSION

FROM wordpress:${WORDPRESS_VERSION}-php${PHP_VERSION}-fpm-alpine

COPY install.sh /install_wordpress.sh

RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
        && chmod +x wp-cli.phar \
        && mv wp-cli.phar /usr/local/bin/wp \
        && chmod +x /install_wordpress.sh

cmd ["/bin/sh", "-c", "/install_wordpress.sh && php-fpm"]