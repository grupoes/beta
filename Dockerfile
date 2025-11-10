FROM php:7.3-apache

# Evitar interacción en apt-get
ENV DEBIAN_FRONTEND=noninteractive

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev zip unzip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd mysqli pdo pdo_mysql mbstring zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copiar configuración PHP personalizada
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Copia la configuración de Apache
COPY apache-config/000-default.conf /etc/apache2/sites-available/000-default.conf

# Habilitar mod_rewrite en Apache (CodeIgniter lo necesita)
RUN a2enmod rewrite


# Configuración de Apache para CodeIgniter
WORKDIR /var/www/html
COPY . /var/www/html

# Permitir .htaccess
RUN chown -R www-data:www-data /var/www/html
