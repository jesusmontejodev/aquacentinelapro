import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/main.css',
                'resources/js/app.js',
                'resources/js/boya/graficaConductividad.js',
                'resources/js/boya/graficaPh.js',
                'resources/js/boya/graficaTemperatura.js',
                'resources/js/boya/graficaTurbidez.js',
                'resources/js/boya/calidadAgua.js',
            ],
            refresh: true,
        }),
    ],
    // ✅ CONFIGURACIÓN MEJORADA PARA PRODUCCIÓN
    build: {
        manifest: true,
        outDir: 'public/build',
        emptyOutDir: true,
        rollupOptions: {
            output: {
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: (assetInfo) => {
                    const ext = assetInfo.name.split('.').pop();
                    if (/css|sass|scss/.test(ext)) {
                        return 'assets/[name]-[hash].[ext]';
                    }
                    if (/png|jpe?g|svg|gif|tiff|bmp|ico/i.test(ext)) {
                        return 'assets/images/[name]-[hash].[ext]';
                    }
                    return `assets/[name]-[hash].[ext]`;
                }
            }
        }
    },
    // ✅ CONFIGURACIÓN MEJORADA DEL SERVER
    server: {
        hmr: {
            host: 'localhost',
            protocol: 'ws'
        },
        host: 'localhost',
        cors: true
    },
});
