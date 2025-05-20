// vite.config.js

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js', // 主要入口文件，将在此文件中导入所有 CSS
            ],
            refresh: true,
        }),
    ],
});
