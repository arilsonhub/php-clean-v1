FROM php:7.4.9-apache

##################### USER CREATION #######################
RUN useradd -ms /bin/bash clean

WORKDIR /home/clean

##################### COPY FILES ##########################
COPY ./app/api/.env.example ./.env
COPY ./app/api/composer.json ./composer.json
COPY ./app/api/composer.lock ./composer.lock
COPY ./app/api ./
COPY ./infra/api/entrypoint.sh /usr/local/bin

################### GENERAL CONFIG ########################
RUN apt-get update \      
  && export DEBIAN_FRONTEND=noninteractive \
  && apt-get install -y tzdata \
  && ln -fs /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime \
  && dpkg-reconfigure --frontend noninteractive tzdata \
  && apt-get install curl -y \
  && apt-get install --yes --no-install-recommends libpq-dev \
  && apt-get install --yes libpng-dev \
  && apt-get install --yes zlib1g-dev \
  && apt-get install --yes libzip-dev \
  && apt-get install --yes zip \
  && apt-get clean && rm -rf /var/lib/apt/lists/* \  
  && chmod +x /usr/local/bin/entrypoint.sh \  
  && chmod -R 777 /etc/apache2/ \
  && chmod 777 ./ \
  && chmod 777 ./bootstrap/cache \
  && chmod -R 777 ./storage/logs

###################### XDEBUG #############################
RUN pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && echo "xdebug.start_with_request=yes" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null \  
  && echo "xdebug.mode=debug" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null \
  && echo "xdebug.discover_client_host=true" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null \
  && echo "xdebug.client_host=localhost" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null \
  && echo "xdebug.idekey=VSCODE" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null \
  && echo "xdebug.log_level=0" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null  

###################### COMPOSER ###########################
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
  && curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
  && php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
  && php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --snapshot \
  && rm -f /tmp/composer-setup.*

###################### APACHE Config ######################
RUN a2enmod rewrite

###################### PHP Config ########################
RUN printf '[PHP]\ndate.timezone = "America/Sao_Paulo"\n' > /usr/local/etc/php/conf.d/tzone.ini

################### PHP EXTENSIONS ########################
RUN docker-php-ext-install pdo_pgsql \
  && docker-php-ext-install zip \
  && docker-php-ext-install bcmath \
  && docker-php-ext-install gd

################### USER #################################
USER clean
