#!/bin/bash

echo "=== Iniciando aplicación Laravel ==="

# Configurar permisos
chown -R www-data:www-data /var/www/storage
chown -R www-data:www-data /var/www/bootstrap/cache

# **SOLUCIÓN TEMPORAL: Volver a usar IP pública mientras solucionamos Cloud SQL Proxy**
echo "Usando conexión directa a Cloud SQL..."
echo "DB_HOST: $DB_HOST"

# Limpiar todo cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Esperar conexión a la base de datos
echo "Esperando conexión a Cloud SQL..."
while ! nc -z $DB_HOST $DB_PORT; do
    echo "Esperando base de datos..."
    sleep 5
done
echo "✅ Cloud SQL conectado"

# Ejecutar migraciones
echo "Ejecutando migraciones..."
php artisan migrate --force

echo "✅ Aplicación lista"

# Iniciar servicios
echo "Iniciando PHP-FPM y Nginx..."
php-fpm -D
nginx -g 'daemon off;'

echo "🚀 Aplicación ejecutándose en puerto 8080"
