import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '127.0.0.1',  // Forcage en IPv4 plutôt que IPv6 en ::1 => Pas de localhost non plus car pas de résolution DnS dans le container docker
        //Car le network du docker en mode Bridge => Conflit de résolution des addresses Ip interne au mac.
        port: 9173 //Changement port binding
    },
});
