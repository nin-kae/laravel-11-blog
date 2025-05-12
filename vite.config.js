// vite.config.js

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss', // 确保 Sass 入口文件在这里列出
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
