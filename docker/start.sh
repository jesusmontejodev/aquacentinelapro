#!/bin/bash

echo "=== Iniciando aplicación Laravel en Google Cloud Run ==="

# Configurar permisos
chown -R www-data:www-data /var/www/storage
chown -R www-data:www-data /var/www/bootstrap/cache

# ✅ VERIFICAR ARQUITECTURA
echo "🔍 Verificando arquitectura..."
ARCH=$(dpkg --print-architecture)
echo "Arquitectura: $ARCH"

# ✅ VERIFICAR APP_KEY
echo "Verificando APP_KEY..."
if [ ! -f .env ]; then
    echo "⚠️  Creando .env desde variables de entorno..."
    cat > .env << EOF
APP_NAME=Laravel
APP_ENV=production
APP_KEY=${APP_KEY:-base64:ljHIMllzrNaIdCmy+Ej/4i4YOuKSffeGKG1EoqnV6Fg=}
APP_DEBUG=false
APP_URL=${APP_URL}

DB_CONNECTION=mysql
DB_HOST=${DB_HOST:-34.31.109.236}
DB_PORT=3306
DB_DATABASE=${DB_DATABASE:-laravel_db}
DB_USERNAME=${DB_USERNAME:-appuser}
DB_PASSWORD=${DB_PASSWORD:-M0nt3j0\$QL_2024_Pr0_L4r4v3l_App}

CACHE_STORE=database
SESSION_DRIVER=database
EOF
fi

# Generar APP_KEY si es necesario
if ! grep -q "APP_KEY=base64:" .env; then
    echo "🔑 Generando APP_KEY..."
    php artisan key:generate --force
fi

echo "✅ Configuración verificada"

# ✅ OPCIÓN A: Conexión directa (Cloud Run tiene IPs autorizadas)
echo "🌐 Conectando a Cloud SQL (${DB_HOST}:${DB_PORT})..."
while ! nc -z $DB_HOST $DB_PORT; do
    echo "⏳ Esperando base de datos..."
    sleep 5
done
echo "✅ Cloud SQL conectado"

# Limpiar cachés
echo "🧹 Limpiando cachés..."
php artisan config:clear
php artisan cache:clear || echo "⚠️  Cache clear falló, continuando..."
php artisan route:clear
php artisan view:clear

# Ejecutar migraciones
echo "🔄 Ejecutando migraciones..."
php artisan migrate --force || echo "⚠️  Migraciones fallaron, continuando..."

# Optimizar
echo "⚡ Optimizando aplicación..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Aplicación lista"

# Iniciar servicios
echo "🚀 Iniciando PHP-FPM y Nginx..."
php-fpm -D
nginx -g 'daemon off;'
