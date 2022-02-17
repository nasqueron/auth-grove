const mix = require('laravel-mix');

mix.less('resources/assets/less/app.less', 'public/css')
    .less('resources/assets/less/login.less', 'public/css')
    .options({
        processCssUrls: false,
    });

