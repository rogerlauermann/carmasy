import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: {
                critical: 'resources/css/critical.css',
                app: 'resources/css/app.css',
                js: 'resources/js/app.js'
            },
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    build: {
        // Production optimizations
        cssCodeSplit: true,
        minify: 'esbuild',
        target: ['es2020', 'edge88', 'firefox78', 'chrome87', 'safari13'],
        rollupOptions: {
            output: {
                manualChunks: (id) => {
                    // Split vendor libraries into separate chunk
                    if (id.includes('node_modules')) {
                        return 'vendor';
                    }
                },
                // Optimize asset naming for caching
                assetFileNames: (assetInfo) => {
                    const info = assetInfo.name.split('.');
                    let extType = info[info.length - 1];
                    if (/\.(css)$/.test(assetInfo.name)) {
                        return `assets/css/[name].[hash][extname]`;
                    }
                    if (/\.(png|jpe?g|svg|gif|tiff|bmp|ico)$/i.test(assetInfo.name)) {
                        return `assets/images/[name].[hash][extname]`;
                    }
                    return `assets/[ext]/[name].[hash][extname]`;
                },
                chunkFileNames: 'assets/js/[name].[hash].js',
                entryFileNames: 'assets/js/[name].[hash].js',
            }
        },
        // Optimize dependencies
        optimizeDeps: {
            include: [],
        },
        // Enable source maps for production debugging (optional)
        sourcemap: false,
        // Set chunk size warning limit
        chunkSizeWarningLimit: 1000,
    },
    // Performance optimizations
    define: {
        __VUE_OPTIONS_API__: false,
        __VUE_PROD_DEVTOOLS__: false,
    },
});
