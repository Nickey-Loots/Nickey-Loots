/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './public/**/*.{html,js,php}',
    './resources/**/*.{html,js,php}',
  ],
  theme: {
    extend: {
      color: {
        'primary': '#EA613A',
      }
    },
  },
  plugins: [],
}

