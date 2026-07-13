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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Space Grotesk', 'sans-serif'],
                mono: ['JetBrains Mono', 'monospace'],
            },
            colors: {
                'be-bg': '#12181F',
                'be-bg-2': '#1B232C',
                'be-amber': '#F5B301',
                'be-copper': '#C9702B',
                'be-cream': '#F7F5F1',
                'be-ink': '#161B22',
                'be-green': '#2E8B57',
            },
            spacing: {
                '18': '4.5rem',
            },
        },
    },

    plugins: [forms],
};
