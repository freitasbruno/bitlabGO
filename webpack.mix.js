const path = require('path');
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
    .copy("resources/js/uikit/uikit.js", "public/js/uikit/uikit.js")
    .copy("resources/js/uikit/uikit-icons.js", "public/js/uikit/uikit-icons.js")
    .minify([
		"public/js/app.js", 
		"public/js/home.js",
		"public/js/uikit/uikit.js",
		"public/js/uikit/uikit-icons.js"
	])
    .version();

mix.sass("resources/sass/style.scss", "public/css/style.css")
    .minify("public/css/style.css")
    .version();
