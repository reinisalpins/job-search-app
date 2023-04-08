const mix = require('laravel-mix');
const {vue} = require("laravel-mix");

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .vue()
    .webpackConfig({
        resolve: {
            extensions: ['*', '.js', '.jsx', '.vue']
        }
    });
