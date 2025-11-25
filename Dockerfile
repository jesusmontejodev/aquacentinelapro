# Usar una imagen base de PHP
FROM php:8.2-fpm

# Establecer variables de entorno
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV PORT=8080

WORKDIR /var/www

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    wget \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    netcat-openbsd \
    gnupg

# ✅ SOLUCIÓN: Instalar Node.js desde NodeSource (versión compatible)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Configurar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring zip gd

# Instalar Cloud SQL Proxy
RUN wget https://dl.google.com/cloudsql/cloud_sql_proxy.linux.amd64 -O /usr/local/bin/cloud_sql_proxy \
    && chmod +x /usr/local/bin/cloud_sql_proxy

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Crear directorios
RUN mkdir -p /run/php /var/run/php /var/log/nginx

# Copiar aplicación
COPY . .

# ✅ SOLUCIÓN: Configurar aplicación con permisos correctos
RUN composer install --no-dev --optimize-autoloader && \
    npm install && \
    npm run build && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Copiar configuraciones
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Permisos
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 8080
CMD ["/usr/local/bin/start.sh"]
