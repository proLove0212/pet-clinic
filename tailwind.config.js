/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js",
      "./src/**/*.{html,js}",
      "./node_modules/tw-elements/dist/js/**/*.js",
    ],
    theme: {
      extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('flowbite/plugin'),
        require("tw-elements/dist/plugin")
    ],
  }
