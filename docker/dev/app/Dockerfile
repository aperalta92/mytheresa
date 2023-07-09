FROM php:8.1-apache

RUN mkdir /etc/apache2/logs
RUN mkdir /etc/apache2/ssl

RUN apt-get update && apt-get install -y --fix-missing libmcrypt-dev locales locales-all cronolog \
   libjpeg62-turbo-dev libmcrypt-dev libssl-dev libjpeg-dev libpng-dev libfreetype6-dev \
   libzip-dev zip unzip libicu-dev libxslt-dev git cron \
   mariadb-client libmagickwand-dev --no-install-recommends nodejs npm \
   && pecl install imagick \
   && docker-php-ext-enable imagick \
   && docker-php-ext-install pdo_mysql bcmath soap \
   && docker-php-ext-configure intl \
   && docker-php-ext-install intl \
   && docker-php-ext-configure gd \
   && docker-php-ext-install gd \
   && docker-php-ext-install xsl \
   && docker-php-ext-install zip

RUN a2enmod rewrite

COPY ./mytheresa.sh /mytheresa.sh
RUN chmod +x /mytheresa.sh
#ENTRYPOINT ["/mytheresa.sh"]
