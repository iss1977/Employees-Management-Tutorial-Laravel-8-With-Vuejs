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

mix.sass('resources/sass/sb-admin2-scss/sb-admin-2.scss', 'public/css/sb-admin2.css');

mix.js('resources/js/sb-admin-2.js', 'public/js');

mix.js(['resources/js/app.js', 'resources/js/delete-modal.js' ], 'public/js/app.js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

mix.sass('resources/sass/fontawesome-free.scss','public/css/fontawesome-free');

mix.copy('resources/images/*.*', 'public/images/');

mix.version();
