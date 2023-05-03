/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
    theme: {
        extend: {},
        colors: {
            green: "#64E380",
            white: "#FFFFFF",
            background: "#FFFFFF",
            tables: "#EFEFEF",
            purp: "#A020F0",
            red: "#FF0000",
            yell: "#FFA500",
            dark: "#1C1B20",
            blue: "#3399E9",
            blue_light: "#83C2F0",
            light: "#D9D9D9",
            search: "#DEDEDE",
            navtext: "#FFFFFF",
            underline: "#3399E9",
            gre1: "#CBCBCB",
            gre2: "#E4E4E4",
        },

        fontFamily: {
            rubik: ['"Rubik"', ...defaultTheme.fontFamily.sans],
            varela: ['"Varela"', ...defaultTheme.fontFamily.sans],
        },
    },
    plugins: [],
};
