import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "primary-color" : "#31b795",
                "second-color":"#33b795",
                "light-blue":"#56dcaf",
                "primary-text" : "#1a3b43",
                "second-text": "#2d6c67"
            },
        },
    },

    plugins: [forms],
};
