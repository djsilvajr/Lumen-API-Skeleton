FROM php:8.3-cli-bullseye

ENV ACCEPT_EULA=Y
ENV DEBIAN_FRONTEND=noninteractive

# Dependências básicas + dos2unix
RUN apt-get update && apt-get install -y \
    ca-certificates gnupg2 curl apt-transport-https \
    unzip git zip libzip-dev libpq-dev \
    unixodbc-dev gcc g++ make autoconf libc-dev pkg-config wget \
    freetds-dev freetds-bin tdsodbc \
    dos2unix

# Extensões PHP
RUN docker-php-ext-install zip pdo pdo_mysql \
    && docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr \
    && docker-php-ext-install pdo_odbc

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Projeto
WORKDIR /var/www

COPY . .

# Script de entrada
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Converte para LF e dá permissão
RUN dos2unix /usr/local/bin/entrypoint.sh && chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000
CMD ["entrypoint.sh"]
