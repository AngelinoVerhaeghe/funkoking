const mix = require('laravel-mix');

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

//Backend:
mix.js('resources/js/app.js', 'public/js').sourceMaps()
    .sass('resources/sass/app.scss', 'public/css').sourceMaps();

mix.js('resources/js/front-app.js', 'public/js').sourceMaps()
    .sass('resources/sass/front-app.scss', 'public/css').sourceMaps();

//mix.copyDirectory('resources/assets/front-assets/fonts', 'public/css/fonts');



