/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');


module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {},
	colors: {
		'background': '#C8C8C8',
		'textGrey': '#434040',
		'green': '#38DA6F',
		'backgroundLight': '#D9D9D9',
	},

	fontFamily: {
		'rubik': ['"Rubik"', ...defaultTheme.fontFamily.sans],
		'varela': ['"Varela"', ...defaultTheme.fontFamily.sans]
	}
  },
  plugins: [],
}
