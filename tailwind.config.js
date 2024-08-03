import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.vue",
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ["Figtree", ...defaultTheme.fontFamily.sans],
        changa: ["Changa", "sans-serif"],
        russo: ["Russo", "sans-serif"],
        dosis: ["Dosis", "sans-serif"],
        josefin: ["Josefin", "sans-serif"],
        lastica: ["Lastica", "sans-serif"],
      },
    },
    backgroundImage: {
      queue: "url('/images/background-main.png')",
    },
  },

  plugins: [forms],
};
