let mix = require("laravel-mix");

mix.postCss("resources/css/app.css", "public", [
    require("tailwindcss"),
]);
