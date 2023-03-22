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
		'tables': '#EFEFEF',
		'white': '#FFFFFF',
		'background': '#C8C8C8',
		'dark': '#434040',
		'blue': '#3399E9',
		'blue_light': '#83C2F0',
		'light': '#D9D9D9',
		'search': '#DEDEDE',
		'navtext': '#CFCFCF',
		'underline': '#3399E9',
	},

	fontFamily: {
		'rubik': ['"Rubik"', ...defaultTheme.fontFamily.sans],
		'varela': ['"Varela"', ...defaultTheme.fontFamily.sans],

	}
  },
  plugins: [],
}
