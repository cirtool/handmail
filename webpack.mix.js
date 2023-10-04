let mix = require("laravel-mix");

mix
    .js("resources/js/app.js", "public")
    .postCss("resources/css/app.css", "public", [
        require("tailwindcss"),
    ])
    .setPublicPath("public")
    .disableSuccessNotifications();
