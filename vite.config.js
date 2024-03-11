import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';



export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/examinationTable.js',
                'resources/js/sectionTable.js',
                'resources/js/questionTable.js',
                'resources/js/categoryTable.js',
                'resources/js/category.js',
                'resources/js/userSummaryPieChart.js',
                'resources/js/categorySummaryBarChart.js',
                'resources/js/imageUpload.js',
                'resources/js/toggleText.js',
                'resources/js/levelCheckbox.js',
                'resources/js/sectionSelect.js',
                'resources/js/mySectionTable.js',
                'resources/js/searchIdQuestionText.js'
            ],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler.js'
        }
    }
});
