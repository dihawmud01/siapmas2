import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js',
                'resources/css/app.css',
                'resources/css/admin.css',
                'resources/css/calendar.css',
                'resources/css/login.css',
                'resources/css/sp.css',
                'resources/css/user.css',
                'resources/js/plugins/apexcharts.js',
                'resources/js/plugins/echarts.js',
                'resources/js/plugins/purecounter.js',
                'resources/js/plugins/swiper.js'],
            refresh: true,
        }),
    ],
});