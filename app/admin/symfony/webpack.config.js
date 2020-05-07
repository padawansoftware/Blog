var Encore = require('@symfony/webpack-encore');
var path = require('path');

Encore
    // Directory where the files are written
    .setOutputPath('public/build/webpack')

    .setPublicPath('/build/webpack')

    // Entry points
    .addEntry('app', './assets/js/app.js')
    .addEntry('login', './assets/js/Security/login.js')
    .addEntry('Collection/form', './assets/js/Collection/form.js')
    .addEntry('Post/index', './assets/js/Post/index.js')
    .addEntry('Post/form', './assets/js/Post/form.js')
    .addEntry('Page/form', './assets/js/Page/form.js')

    .addAliases({
        "@css": path.resolve(__dirname, 'assets/css'),
        "@js": path.resolve(__dirname, 'assets/js'),
    })

    // Configure file-loader in images
    .configureLoaderRule('images', loaderRule => {
         loaderRule.options.esModule =  false;
    })

    // Source code detection for browsers
    .enableSourceMaps(!Encore.isProduction())

    .cleanupOutputBeforeBuild()
    .enableSingleRuntimeChunk()
    .enableVersioning()

    .enableSassLoader()
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
