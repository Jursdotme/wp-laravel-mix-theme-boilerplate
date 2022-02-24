const mix = require('laravel-mix');


mix.js("assets/js/app.js", "public/js").vue({ version: 3 })
    .postCss("assets/css/app.css", "public/css");

// mix.alias({
//     vue: 'vue/dist/vue.esm-bundler.js'
// });
