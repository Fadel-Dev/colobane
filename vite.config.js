import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        target: 'ES2020',
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        if (id.includes('vue')) {
                            return 'vue-vendor';
                        }
                        if (id.includes('inertia')) {
                            return 'inertia-vendor';
                        }
                        if (id.includes('leaflet')) {
                            return 'leaflet';
                        }
                        return 'vendor';
                    }
                }
            }
        },
        cssCodeSplit: true,
        reportCompressedSize: false,
        chunkSizeWarningLimit: 500,
        sourcemap: false,
    },
    optimize: {
        exclude: ['node_modules/.vite'],
    },
});
