/** @type {import('tailwindcss').Config} */
import {
  fluidExtractor,
  fluidCorePlugins,
  defaultThemeFontSizeInRems,
} from "fluid-tailwind";

module.exports = {
  content: {
    files: ["./src/**/*.{html,js}"],
    extract: fluidExtractor(),
  },
  theme: {
    fontSize: defaultThemeFontSizeInRems,
    screens: {
      sm: "640px",
      md: "836px",
      lg: "1024px",
      xl: "1280px",
      "2xl": "1535px",
    },
    extend: {
      fontFamily: {
        poppin: ['"Poppins"', "sans-serif"],
        heebo: ['"Heebo"', "sans-serif"],
        quicksand: ['"Quicksand"', "sans-serif"],
        archivo: ['"Archivo"', "sans-serif"],
      },
      colors: {
        "licorice-xl": "#3D3029",
        "licorice-l": "#40322a",
        floral: "#fdfaf5",
        dogwood: "#CCB6A9",
        champagne: "#f1eae1",
        mortuum: "#632B29",
        jasmine: "#F6DB65",
        licorice: "#211A16",
        accent: "#f6c615",
        "accent-dark": "#d0a508",
        "bg-normal": "#ebebeb",
      },
    },
  },
  plugins: [fluidCorePlugins],
};
