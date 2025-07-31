import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import purgecssModule from '@fullhuman/postcss-purgecss';
const purgecss = purgecssModule.default;

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    css: {
        postcss: {
            plugins: [
                purgecss({
                    content: [
                        './resources/views/**/*.blade.php',
                        './resources/js/**/*.js',
                        './resources/js/**/*.vue',
                    ],
                    safelist: ['active', 'show', /^btn-/]
                })
            ]
        }
    }
});
