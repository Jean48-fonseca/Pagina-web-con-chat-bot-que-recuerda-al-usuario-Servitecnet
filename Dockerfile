FROM php:8.2-apache

# 1. Instalar herramientas, Node.js y PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev zip unzip git curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && a2enmod rewrite

# 2. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Mover el código a la carpeta del servidor
WORKDIR /var/www/html
COPY . .

# 4. Instalar dependencias
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# 5. Dar permisos de seguridad
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 6. Configurar Apache para que apunte a 'public'
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 7. Migrar base de datos y encender la web
CMD php artisan migrate --force && apache2-foreground