import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        manifest: true, // Generates a manifest file for asset versioning
        outDir: 'public/build', // Output directory for built assets
        emptyOutDir: true, // Clears the output directory before building
    },
});
