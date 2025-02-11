import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                siemreap: ['Siemreap', 'sans-serif'],
                koulen: ["Koulen", "serif"],
                battambang: ["Battambang", "serif"],
                muol: ["Muol", "serif"],
                khmer: ['Khmer OS Muol Light', 'Arial', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
