import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { readdirSync } from 'fs';
import { resolve, extname } from 'path';

// Helper function to recursively get all .css and .js files
function getAllFiles(dirPath, fileTypes) {
    let files = [];
    const items = readdirSync(dirPath, { withFileTypes: true });

    for (const item of items) {
        const fullPath = resolve(dirPath, item.name);
        if (item.isDirectory()) {
            files = [...files, ...getAllFiles(fullPath, fileTypes)];
        } else if (fileTypes.includes(extname(item.name))) {
            files.push(fullPath);
        }
    }

    return files;
}

export default defineConfig({
    plugins: [
        laravel({
            input: getAllFiles('resources', ['.css', '.js']),
            refresh: true,
        }),
    ],
});
