import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const colors = require('tailwindcss/colors')
import flowbite from "flowbite/plugin"
/** @type {import('tailwindcss').Config} */

// 0b9b8a,f596a1,fadeeb,c4e1f6,f9c975
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
            screens: {
                'sm': { 'max': '767px' },
                'md': { 'min': '767px', 'max': '1024px' },
                'lg': { 'min': '1024px', 'max': '1280px' },
                'xl': { 'min': '1280px' },
            },
            backgroundImage: {
                'footer-shape': "url('/images/3.png')",
            }
        },
        colors: {
            'primary': '#7CC51F',
            'second': '#556F7B',
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            white: colors.white,
            gray: colors.gray,
            emerald: colors.emerald,
            indigo: colors.indigo,
            yellow: colors.yellow,
            slate:colors.slate,
            lime:colors.lime,
            orange:colors.orange,
        }
    },
    plugins: [forms, require('flowbite/plugin')],
};
