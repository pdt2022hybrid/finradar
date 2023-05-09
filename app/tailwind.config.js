/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
    theme: {
        extend: {},
        colors: {
            green: "#64E380",
            purp: "#A020F0",
            red: "#FF0000",
            yell: "#FFA500",
            gray: "#EFEFEF",
            white: "#FFFFFF",
            background: "#FFFFFF",
            dark: "#1C1B20",
            blue: "#3399E9",
            blue_light: "#83C2F0",
            light: "#CBCBCB",
            search: "#DEDEDE",
            navtext: "#FFFFFF",
            underline: "#3399E9",
			searchborder:"#5F5F5F",
        },
        fontFamily: {
            rubik: ['"Rubik"', ...defaultTheme.fontFamily.sans],
            varela: ['"Varela"', ...defaultTheme.fontFamily.sans],
        },
		minWidth: {
			'lg':'1520px',
			'md':'769px',
		}
    },
    plugins: [],
};
