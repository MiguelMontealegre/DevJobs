const mix = require('laravel-mix');
require('laravel-mix-tailwind');

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

    //Cuando este archivo se edite hay que reiniciar nuestro servidor ...php artisan serve

    mix.js('resources/js/app.js', 'public/js')    
    .autoload({
      jquery: ['$', 'window.jQuery', 'jQuery']
      })  
         .vue()    
         .sass('resources/sass/app.scss', 'public/css')      
         .postCss("resources/css/app.css", "public/css", [         
          require("tailwindcss"),
      ]);