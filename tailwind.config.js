/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './wp-content/themes/royesh-theme/**/*.php',
    './wp-content/themes/royesh-theme/**/*.js',
    './_static_source/**/*.php',
    './_static_source/**/*.html',
    './_static_source/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        royesh: {
          cream: '#F5F4EE',
          'cream-dark': '#E8E2D2',
          border: '#DED6CA',
          green: '#014235',
          gold: '#B1862D',
          'gold-hover': '#9c7524',
        }
      },
      fontFamily: {
        sans: ['YekanBakhVF', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        heading: ['PeydaWebVF', 'sans-serif'],
      }
    },
  },
  safelist: [
    { pattern: /bg-\[.*\]/ },
    { pattern: /text-\[.*\]/ },
    { pattern: /border-\[.*\]/ },
    { pattern: /h-\[.*\]/ },
    { pattern: /w-\[.*\]/ },
    { pattern: /max-w-\[.*\]/ },
    { pattern: /min-h-\[.*\]/ },
    { pattern: /top-\[.*\]/ },
    { pattern: /rounded-\[.*\]/ },
    { pattern: /px-\[.*\]/ },
    { pattern: /py-\[.*\]/ },
    { pattern: /gap-\[.*\]/ },
    { pattern: /leading-\[.*\]/ },
    { pattern: /z-\[.*\]/ },
  ],
  plugins: [],
}
