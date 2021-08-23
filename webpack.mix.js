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

mix.scripts([
  'resources/js/app.js'
], 'public/js/app.js')
  .sass('resources/sass/affiliates.scss', 'public/css')
  .copyDirectory('resources/js/ibuumerang', 'public/js/ibuumerang');
mix.copy('resources/js/ibuumerang/dashboard/widgets/buumerang.js',
  'public/js/ibuumerang/dashboard/widgets/buumerang.js');
mix.copy('resources/js/ibuumerang/myprofile/myprofile.js',
  'public/js/ibuumerang/myprofile/myprofile.js');
mix.copy('resources/js/ibuumerang/reports/entire_organization.js',
  'public/js/ibuumerang/reports/entire_organization.js');  
// if (mix.inProduction()) {
mix.version();
// }