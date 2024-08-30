FROM php:8.3-apache

# Instala dependências necessárias
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql

# Habilitar mod_rewrite do Apache
RUN a2enmod rewrite

# Copia o arquivo de configuração customizado do Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia todos os arquivos do projeto para o diretório do Apache
COPY . /var/www/html
