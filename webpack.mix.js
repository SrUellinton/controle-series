const mix = require("laravel-mix");

mix
    .sass("resources/scss/app.scss", "public/css")
    .copyDirectory('resources/assets/img', 'public/assets/img');
