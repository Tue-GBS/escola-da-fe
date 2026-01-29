# Imagem oficial do PHP com Apache
FROM php:8.2-apache

# Habilita o mod_rewrite (se você vier a usar URLs bonitas)
RUN a2enmod rewrite

# Permite uso de .htaccess
RUN sed -ri "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf

# Copia os arquivos do projeto para o diretório padrão do Apache
COPY . /var/www/html/

# Define a pasta de trabalho
WORKDIR /var/www/html

# Ajusta permissões (opcional, mas ajuda em alguns ambientes)
RUN chown -R www-data:www-data /var/www/html

# Expondo a porta HTTP
EXPOSE 80
