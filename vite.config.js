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
});
