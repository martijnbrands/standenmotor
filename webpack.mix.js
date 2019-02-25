let mix = require('laravel-mix');

mix.webpackConfig({
    resolve:{
        extensions: ['.js', '.vue'],
        alias: {
            '@': __dirname + '/resources'
        }
    }
});

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

mix.js('resources/js/main.js', 'public/js');
    // .sass('resources/sass/app.sass', 'public/css');

// mix.js('resources/assets/js/app.js', 'public/js')
//        .js('resources/assets/js/vueapp.js', 'public/js')
//        .sass('resources/assets/sass/app.scss', 'public/css');