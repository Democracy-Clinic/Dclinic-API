const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/script/app.js', 'public/js')
// .vue();
// mix.postCss('resources/css/app.css', 'public/css', [
//     require('postcss-import'),
//     require('tailwindcss'),
//     require('autoprefixer'),
// ]);

mix.js('resources/script/app.js', 'public/js')
  .vue();
mix.sass('resources/sass/app.scss', 'public/css');

mix.scripts([
  'resources/js/jquery.min.js',
  'resources/js/bootstrap-3/bootstrap.bundle.min.js',
  'resources/js/theme/clean-blog.min.js',
  'resources/js/plyr.min.js',
], 'public/js/main-page.js');

mix.styles([
  'resources/css/bootstrap-3/bootstrap.css',
  'resources/css/font-awesome/font-awesome.min.css',
  'resources/css/theme/clean-blog.min.css',
  'resources/css/plyr.css',
], 'public/css/main-page.css');

mix.scripts([
  'resources/vendor/jquery/jquery.min.js',
  'resources/vendor/bootstrap/js/bootstrap.min.js',
  'resources/vendor/metisMenu/metisMenu.min.js',
  'resources/vendor/raphael/raphael.min.js',
  'resources/vendor/datatables/js/jquery.dataTables.min.js',
  'resources/vendor/datatables-plugins/dataTables.bootstrap.min.js',
  'resources/vendor/datatables-responsive/dataTables.responsive.js',
  'resources/dist/js/sb-admin-2.js',
], 'public/js/admin.js');

mix.styles([
  'resources/vendor/bootstrap/css/bootstrap.min.css',
  'resources/vendor/metisMenu/metisMenu.min.css',
  'resources/dist/css/sb-admin-2.css',
  'resources/vendor/font-awesome/css/font-awesome.min.css',
  'resources/vendor/datatables-responsive/dataTables.responsive.css',
], 'public/css/admin.css');