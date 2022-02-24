const mix = require('laravel-mix');

mix.js("assets/js/app.js", "public/js")
    .postCss("assets/css/app.css", "public/css");