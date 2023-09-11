import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const colors = require('tailwindcss/colors')
/** @type {import('tailwindcss').Config} */
export default {
   darkMode:"class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
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
        },
    },

    plugins: [forms],
};
