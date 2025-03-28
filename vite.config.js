import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/import.js",
                "resources/js/loadingscreen.js",
                "resources/js/sheetTable.js",
                "resources/js/exportToExcel.js",
                "resources/js/exportToExcel_branch.js",
                "resources/js/bootstrap.js",
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: "public/build",
    },
});
