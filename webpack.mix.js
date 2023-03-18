const mix = require("laravel-mix");

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/css/estilos.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);
