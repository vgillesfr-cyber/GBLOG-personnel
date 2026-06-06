FROM php:8.2-cli

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Installer les dépendances sans scripts (artisan n'existe pas encore)
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-scripts --prefer-dist

# Copier le code, puis finaliser l'autoload + découverte des packages
COPY . .
ENV APP_KEY=base64:dGVtcG9yYXJ5a2V5Zm9yYnVpbGRvbmx5MDEyMzQ1Njc4OTA=
RUN composer dump-autoload --optimize --no-interaction

RUN sed -i 's/\r$//' scripts/railway-start.sh \
    && chmod +x scripts/railway-start.sh

EXPOSE 8000

CMD ["bash", "scripts/railway-start.sh"]
