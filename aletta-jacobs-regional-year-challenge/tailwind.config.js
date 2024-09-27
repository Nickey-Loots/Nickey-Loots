/** @type {import('tailwindcss').Config} */
const primary_color = "#1D3557";
const primary_color_light = "#778DA9";
const primary_color_dark = "#0D1B2A";
const secondary_color = "#E0E1DD";

const outfit = ['Outfit', 'sans-serif']
module.exports = {
  content: ["./Site/**/*.html", "./Site/**/*.js"],
  theme: {
    extend: {
      colors: {
        "primary": primary_color,
        "primary-light": primary_color_light,
        "primary-dark": primary_color_dark,
        "secondary": secondary_color,
      },
      fontFamily: {
        "outfit": outfit,
      },
    },
  },
  plugins: [],
}

