FROM php:8.1.10-fpm
RUN rm /etc/apt/preferences.d/no-debian-php \
&& apt-get update && apt-get install -y \
libmcrypt-dev libpq-dev libcurl4-openssl-dev \
libxml2-dev libpng-dev zlib1g-dev libzip-dev make git wget \
openssl php-soap libxml2-dev libyaml-dev
RUN docker-php-ext-install bcmath pgsql zip pdo_pgsql soap gd
RUN pecl install mcrypt xdebug grpc yaml
RUN docker-php-ext-enable mcrypt xdebug pdo_pgsql soap gd grpc.so yaml
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.extended_info=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "upload_max_filesize = 1000M" >> /usr/local/etc/php/php.ini
RUN echo "post_max_size = 1000M" >> /usr/local/etc/php/php.ini
RUN echo "memory_limit = 2048M" >> /usr/local/etc/php/php.ini
RUN echo "request_order  = EGPS" >> /usr/local/etc/php/php.ini
RUN echo alias codecept="/var/www/pba/vendor/bin/codecept" >> ~/.bashrc
WORKDIR /var/www/app