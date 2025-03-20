FROM php:8.1-apache

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar archivos al servidor
COPY . /var/www/html/

# Establecer permisos correctos
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]
