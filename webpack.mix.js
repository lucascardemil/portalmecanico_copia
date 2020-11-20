let mix = require('laravel-mix');

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
mix.js([
    'resources/assets/js/sbAdmin/sb-admin.js',
    ],'public/js/app-principal.js')
mix.js(['resources/assets/js/app.js'], 'public/js')
.styles([
    'resources/assets/css/bootstrap-4.1.1.css',
    'resources/assets/css/sbAdmin/sb-admin.css',
    'resources/assets/css/toastr.css',
    'node_modules/bootstrap4-fullscreen-modal/dist/bootstrap4-modal-fullscreen.css',
    'node_modules/axios-progress-bar/dist/nprogress.css',
], 'public/css/app-principal.css')
   .sass('resources/assets/sass/app.scss', 'public/css');
