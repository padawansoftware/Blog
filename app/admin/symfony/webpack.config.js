var Encore = require('@symfony/webpack-encore');

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

    // Source code detection for browsers
    .enableSourceMaps(!Encore.isProduction())

    // Refresh assets on each build
    .cleanupOutputBeforeBuild()
    .enableVersioning()

    .enableSassLoader()

    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
