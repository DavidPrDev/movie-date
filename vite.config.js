import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

import * as dotenv from 'dotenv';
import { expand } from 'dotenv-expand';

// Cargar y expandir variables de entorno desde la ruta especificada
const myEnv = dotenv.config({ path: './new/.env' });
expand(myEnv);
 
export default defineConfig({
    plugins: [
        laravel(['resources/css/app.css','resources/js/app.js']),
        vue({
            template: {
                transformAssetUrls: {

                    base: null,
 
                    includeAbsolute: false,
                },
            },
        }),
    ],
});