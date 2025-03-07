import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/auth.css',
                'resources/css/login.css',
                'resources/css/dashboard.css',
                'resources/css/register.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: "0.0.0.0", // Allow access from all network interfaces
        port: 5173,
        strictPort: true,
        hmr: {
            host: "localhost", // Change to your Docker container's IP if needed
            clientPort: 5173,
            protocol: "ws", // WebSocket for HMR
        },
        watch: {
            usePolling: true, // Required for Docker volume mounting
        },
    }
});
