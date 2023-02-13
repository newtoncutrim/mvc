FROM php:8.2-apache
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql
WORKDIR /var/www
COPY . .