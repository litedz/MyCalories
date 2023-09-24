import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const colors = require('tailwindcss/colors')
import flowbite from "flowbite/plugin"
/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],
    safelist: [
        'bg-red-700',
        'bg-red-500',
        'bg-yellow-500',
        'bg-yellow-300',
        'bg-green-600',
        'bg-slate-700',

    ],
    theme: {
        extend: {
            screens:{
                'sm': {'max': '767px'},
            }
        },
    },
    plugins: [forms, require('flowbite/plugin')],
};
