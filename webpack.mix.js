const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
const path = require('path');

mix.js('resources/js/website/app.js', 'public/dist/website/js') // for vanilla JS
.js('resources/js/admin/app.js', 'public/dist/admin/js').vue() // for the Vue.js app
.postCss('resources/css/website/app.css', 'public/dist/website/css', [
   tailwindcss('tw.website.config.js'),
])
.postCss('resources/css/admin/app.css', 'public/dist/admin/css', [
   tailwindcss('tw.admin.config.js'),
])
.alias({
    '@': path.join(__dirname, 'resources/js'),
    '@website': path.join(__dirname, 'resources/js/website'),
    '@admin': path.join(__dirname, 'resources/js/admin'),
})
.options({
    processCssUrls: false
})
.disableSuccessNotifications()
.sourceMaps();

if (mix.inProduction()) {
    mix.version();
}
