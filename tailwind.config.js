/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./public/Script/*.js",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("tailwind-scrollbar")({ nocompatible: true })],
};
