# Usar imagen oficial de PHP
FROM php:8.2-fpm

# Variables de entorno
ENV PORT=8080

WORKDIR /var/www

# Instalar lo mínimo indispensable
RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Extensiones PHP esenciales
RUN docker-php-ext-install pdo_mysql mbstring

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar aplicación
COPY . .

# Dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Dependencias Node (si existen)
RUN [ -f "package.json" ] && npm install || echo "No package.json"

# Script de inicio
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Permisos
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 8080

CMD ["/usr/local/bin/start.sh"]
