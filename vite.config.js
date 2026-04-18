import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/css/styles.css',
                'resources/css/styles2.css',
                'resources/css/styles_appointments.css',
                'resources/css/styles_forgetpass.css',
                'resources/css/styles_resetpass.css',
                'resources/js/navbar.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
