FROM php:8.2-fpm-alpine

RUN sed -i 's/;date.timezone =/date.timezone=\"America\/Sao_Paulo\"/g' $PHP_INI_DIR/php.ini-development

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY ./.docker/90-xdebug.ini "${PHP_INI_DIR}/conf.d"

RUN apk update --no-cache \
  && apk add pcre-dev ${PHPIZE_DEPS} \
  linux-headers \
  icu-dev \
  oniguruma-dev \
  tzdata \
  && pecl install xdebug \
  && docker-php-ext-install intl \
  && docker-php-ext-install pcntl \
  && docker-php-ext-install mysqli \
  && docker-php-ext-install pdo_mysql \
  && docker-php-ext-install mbstring \
  && docker-php-ext-install bcmath \
  && docker-php-ext-install opcache \
  && docker-php-ext-enable xdebug \
  && apk del pcre-dev ${PHPIZE_DEPS}

RUN rm -rf /var/cache/apk/*

CMD ["php-fpm"]
