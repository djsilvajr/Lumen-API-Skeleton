#!/bin/bash

cd /var/www

# Garante .env
if [ ! -f .env ] && [ -f .env.example ]; then
    cp .env.example .env
fi

# Instala pacotes composer
if [ ! -d vendor ]; then
    composer install
fi

# Gera JWT_SECRET se não existir
if ! grep -q "JWT_SECRET=" .env; then
    php artisan jwt:secret
fi

php -S 0.0.0.0:9000 -t public