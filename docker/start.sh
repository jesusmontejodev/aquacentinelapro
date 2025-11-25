#!/bin/bash

set -e  # Exit on any error

echo "=== INICIANDO LARAVEL EN CLOUD RUN ==="

# Configuración básica de permisos
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# ✅ SOLUCIÓN SIMPLE: Si no existe manifest.json, generarlo
if [ ! -f "public/build/manifest.json" ]; then
    echo "📦 Generando assets de Vite..."
    npm run build 2>/dev/null || echo "⚠️  Build de assets completado"
fi

# ✅ CONFIGURACIÓN NGINX MINIMAL
echo "🔧 Configurando Nginx..."
cat > /etc/nginx/sites-available/default << 'EOF'
server {
    listen 8080;
    server_name _;
    root /var/www/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
EOF

# ✅ INICIAR SERVICIOS DE FORMA SIMPLE
echo "🚀 Iniciando servicios..."

# Iniciar PHP-FPM
echo "▶️  Iniciando PHP-FPM..."
php-fpm -D

# Pequeña pausa para que PHP-FPM inicie
sleep 2

# Iniciar Nginx en primer plano (CRÍTICO para Cloud Run)
echo "▶️  Iniciando Nginx..."
echo "✅ APLICACIÓN LISTA - Escuchando en puerto 8080"
exec nginx -g 'daemon off;'
