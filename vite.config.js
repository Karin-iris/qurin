import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/userSummaryPieChart.js',
                'resources/js/categorySummaryBarChart.js'
            ],
            refresh: true,
        }),
        vue(),
    ],
});
