# Imagem oficial do PHP com Apache
FROM php:8.2-apache

# Habilita o mod_rewrite (se você vier a usar URLs bonitas)
RUN a2enmod rewrite

# Copia os arquivos do projeto para o diretório padrão do Apache
COPY . /var/www/html/

# Define a pasta de trabalho
WORKDIR /var/www/html

# Ajusta permissões (opcional, mas ajuda em alguns ambientes)
RUN chown -R www-data:www-data /var/www/html

# Expondo a porta HTTP
EXPOSE 80
