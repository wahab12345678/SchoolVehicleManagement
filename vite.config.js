import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/dashboard.js',
                'resources/js/students/custom.js',
                'resources/js/guardians/custom.js',
                'resources/js/vehicles/custom.js',
                'resources/js/drivers/custom.js',
                'resources/js/routes/custom.js',
                'resources/js/trips/custom.js',
                'resources/js/schools/custom.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['bootstrap', 'jquery'],
                    charts: ['chart.js'],
                    maps: ['leaflet'],
                    select2: ['select2'],
                }
            }
        },
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true,
                pure_funcs: ['console.log', 'console.info', 'console.debug'],
            },
        },
        sourcemap: false,
        cssCodeSplit: true,
        chunkSizeWarningLimit: 1000,
    },
    server: {
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: true,
        },
    },
    optimizeDeps: {
        include: [
            'bootstrap',
            'jquery',
            'chart.js',
            'leaflet',
            'select2',
            'axios'
        ],
    },
    define: {
        'process.env.NODE_ENV': JSON.stringify(process.env.NODE_ENV || 'development'),
    },
});