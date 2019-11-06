const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js");
mix.copy("resources/js/app.js", "public/js/app.js")    
    .copy("resources/js/home.js", "public/js/home.js")
    .minify([
        "public/js/app.js",
        "public/js/home.js"
    ])
    .version();

mix.sass("resources/sass/app.scss", "public/css/app.css")
    .minify("public/css/app.css")
    .version();

mix.sass("resources/sass/style.scss", "public/css/style.css")
    .minify("public/css/style.css")
    .version();
