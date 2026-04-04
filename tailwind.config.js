/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./template-parts/**/*.php", "./src/**/*.{js,jsx}"],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Poppins", "sans-serif"],
      },
      colors: {
        primary: "#DA3636",
        secondary: "#FFFFFF",
        accent: "#FFC107",
        textPrimary: "#212121",
        textSecondary: "#5B5575",
        textPrimary2: "#211B3D",
      },
    },
  },
  plugins: [],
};
