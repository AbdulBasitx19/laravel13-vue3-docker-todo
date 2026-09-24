FROM php:8.3-apache

# System Packages & Node.js Installation (Vue.js build tools ke liye)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    zip \
    unzip \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# PHP Extensions and mysql k liay 
RUN docker-php-ext-install pdo_mysql gd

# Enable Apache Rewrite Rules
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# working directory container k andar 
WORKDIR /var/www/html

# Update Apache Document Root to Laravel public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf