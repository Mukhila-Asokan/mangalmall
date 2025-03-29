import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.jsx', 
                'resources/js/mount-venuecalendar.jsx'  // ✅ Ensure this file is included
            ],
            refresh: true,
        }),
	    react({
            jsxRuntime: 'automatic',
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build', // Correct build path
    },
    resolve: {
        alias: {
            '@': '/resources/js', 
        },
    },
});
