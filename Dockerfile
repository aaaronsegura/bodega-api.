# 1. Usamos una imagen base de PHP con Apache preinstalado
FROM php:8.4-apache

# 2. Instalamos dependencias del sistema (librerías de Linux necesarias)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# 3. Limpiamos cache para reducir peso de la imagen
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 4. Instalamos extensiones de PHP que necesita Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 5. Habilitamos el módulo "rewrite" de Apache (vital para las rutas de Laravel)
RUN a2enmod rewrite

# 6. Instalamos Composer dentro del contenedor
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Configuramos el directorio de trabajo
WORKDIR /var/www/html

# 8. Copiamos los archivos de tu proyecto al contenedor
COPY . .

# 9. Instalamos las dependencias de Laravel (vendor)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 10. Ajustamos permisos (para que Apache pueda escribir en storage)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 11. Cambiamos la configuración de Apache para que apunte a la carpeta public
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# 12. Exponemos el puerto 80
EXPOSE 80