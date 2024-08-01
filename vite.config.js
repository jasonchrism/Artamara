import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


// Helper function to get all files from a directory
function getFilesFromDir(dir, ext) {
    const fs = require('fs');
    const path = require('path');
    return fs.readdirSync(dir).filter(file => file.endsWith(ext)).map(file => path.join(dir, file));
}

// Get all CSS files from the buyer, admin, and artist directories
const buyerCssFiles = getFilesFromDir('resources/css/buyer', '.css');
const buyerOrderCssFiles = getFilesFromDir('resources/css/buyer/order', '.css');
// Similarly, you can add paths for admin and artist directories if they exist
const adminCssFiles = getFilesFromDir('resources/css/admin', '.css');
const artistCssFiles = getFilesFromDir('resources/css/artist', '.css');
const artistTransactionCssFiles = getFilesFromDir('resources/css/artist/transactions', '.css');
const generalCssFiles = getFilesFromDir('resources/css', '.css');
const generalJsFiles = getFilesFromDir('resources/js', '.js');
const generalSassFiles = getFilesFromDir('resources/sass', '.scss');

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...buyerCssFiles,
                ...adminCssFiles,
                ...artistCssFiles,
                ...generalCssFiles,
                ...buyerOrderCssFiles,
                ...artistTransactionCssFiles,
                ...generalJsFiles,
                ...generalSassFiles
            ],
            refresh: true,
        }),
    ],
});
