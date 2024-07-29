# Use a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instale as extensões necessárias
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install intl pdo pdo_mysql

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configure o diretório do projeto
WORKDIR /var/www/html

# Copie o código-fonte para o contêiner
COPY . .

# Ajuste o DocumentRoot para o diretório específico
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/webroot|' /etc/apache2/sites-available/000-default.conf

# Habilite o módulo de reescrita
RUN a2enmod rewrite

# Adicione o alias para o comando bin/cake
RUN echo "alias cake='bin/cake'" >> ~/.bashrc

# Exponha a porta padrão do Apache
EXPOSE 80

# Inicie o Apache em segundo plano
CMD ["apache2-foreground"]
