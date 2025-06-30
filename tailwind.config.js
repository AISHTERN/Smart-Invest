import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "gradient-start": "#AFB3FF",
                "gradient-end": "#E0F7FA",
                primary: "#6C5CE7",
                secondary: "#2DA1A2",
                customBlue: "#AFB3FF",
                customLight: "#E0F7FA",
            },
            backgroundImage: {
                "custom-gradient":
                    "linear-gradient(to right, #AFB3FF, #E0F7FA)",
            },
        },
    },

    plugins: [forms],
};
