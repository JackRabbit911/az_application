/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./application/app/views/tw/**/*.{html,js,twig}",
    "./application/auth/views/tw/*.twig",
    "./application/modules/Guide/views/*.twig"
  ],
  safelist: [
    'input-error',
    'input-success',
    'checkbox-error',
    'checkbox-success',
    'select-error',
    'select-success',
    'radio-error',
    'file-input-error',
    'textarea-error',
    'textarea-success',
  ],
  theme: {
    extend: {},
  },
  plugins: [require("@tailwindcss/typography"), require("daisyui")],
  daisyui: {
    themes: true, // false: only light + dark | true: all themes | array: specific themes like this ["light", "dark", "cupcake"]
    darkTheme: "dark", // name of one of the included themes for dark mode
    base: true, // applies background color and foreground color for root element by default
    styled: true, // include daisyUI colors and design decisions for all components
    utils: true, // adds responsive and modifier utility classes
    prefix: "", // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
    logs: true, // Shows info about daisyUI version and used config in the console when building your CSS
    themeRoot: ":root",
  }
}

