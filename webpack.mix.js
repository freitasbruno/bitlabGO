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

mix.copy("resources/js/home.js", "public/js/home.js")
    .minify([
		"public/js/home.js"
	]);

mix.sass("resources/sass/style.scss", "public/css/style.css")
    .minify("public/css/style.css");

if (mix.inProduction()) {
	mix.version();
}

mix.browserSync('localhost:8000');