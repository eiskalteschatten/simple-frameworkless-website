FROM php:8.2-apache

RUN a2enmod rewrite

COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/
WORKDIR /var/www/html/

RUN chown -R www-data:www-data /var/www/html/ && \
    chmod -R 755 /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]
