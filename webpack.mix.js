const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/admin.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/admin.scss', 'public/css')
   .copy('resources/css/app.css', 'public/css')
   .copy('resources/css/admin.css', 'public/css')
   .sourceMaps()
   .version();

if (mix.inProduction()) {
    mix.version();
}
