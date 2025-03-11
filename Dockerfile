# Usa la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Copia el código de tu proyecto al servidor Apache
COPY . /var/www/html/

# Expone el puerto 80 (Render lo usará)
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]
