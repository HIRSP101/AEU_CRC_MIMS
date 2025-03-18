import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                // "resource/js/exportToExcel_branch.js",
                // "resource/js/exportToExcel.js",
                // "resource/js/import.js",
                // "resource/js/loadingscreen.js",
                // "resource/js/sheetTable.js",
                // "resource/js/userform.js",
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: "public/build",
    },
});
