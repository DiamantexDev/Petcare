FROM php:8.2-apache

# Extensão do MySQL (PDO) usada pelo projeto
RUN docker-php-ext-install pdo_mysql

# Configuração de produção do PHP (erros não aparecem para o visitante)
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && printf "date.timezone=America/Sao_Paulo\nexpose_php=Off\n" > "$PHP_INI_DIR/conf.d/petcare.ini"

# O Render informa a porta na variável PORT (padrão 10000)
ENV PORT=10000
RUN sed -i 's/^Listen 80$/Listen ${PORT}/' /etc/apache2/ports.conf
COPY docker/apache-site.conf /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html

EXPOSE 10000
