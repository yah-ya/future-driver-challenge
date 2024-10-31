FROM php:8.3-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install \
    pdo_mysql \
    intl \
    mbstring \
    zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

EXPOSE 8000

CMD [ "php", "-S", "0.0.0.0:8000"]