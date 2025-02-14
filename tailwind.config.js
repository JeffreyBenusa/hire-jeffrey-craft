/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./templates/**/*.twig",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          "DEFAULT": "#1E3A8A",
          light: "#3B82F6",
          dark: "#172554"
        },
        teal: {
          "DEFAULT": "#14B8A6",
          light: "#5EEAD4",
          dark: "#0F766E"
        },
        gray: {
          "DEFAULT": "#E5E7EB",
          light: "#F3F4F6",
          dark: "#1f2937"
        },
        accent: {
          "DEFAULT": "#F97316",
          light: "#FDBA74",
          dark: "#C2410C"
        },
        navy: {
          "DEFAULT": "#0F172A",
          light: "#1E293B",
          dark: "#020617"
        }
      },
      fontFamily: {
        sans: ['Roboto', 'ui-sans-serif', 'system-ui'], // Set Roboto as default sans-serif
      },
    },
  },
  plugins: [],
}