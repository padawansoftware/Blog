const VueLoaderPlugin = require('vue-loader/lib/plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const VueAutoRoutingPlugin = require('vue-auto-routing/lib/webpack-plugin');
const path = require('path');
const Dotenv = require('dotenv-webpack');
const environment = process.env.SERVER_ENV || '';

module.exports = {
    mode: "development",
    context: path.resolve(__dirname),
    entry: './src/main.js',
    output: {
        filename: 'app.[contenthash].js',
        publicPath: '/'
    },
    resolve: {
        alias: {
            '@repository': path.resolve(__dirname, 'src/api/repository'),
            '@components': path.resolve(__dirname, 'src/components'),
            '@views': path.resolve(__dirname, 'src/views'),
            '@routes': path.resolve(__dirname, 'src/config/Routes'),
            '@': path.resolve(__dirname, 'src')
        }
    },
    module: {
        noParse: /^(vue|vue-router|vuex|vuex-router-sync)$/,
        rules: [
            {
                test: /\.vue$/,
                use: 'vue-loader'
            },
            {
                test: /\.(css|scss)$/,
                use: ['style-loader','css-loader', 'sass-loader']
            },
            {
                test: /\.(png|jpe?g|gif|webp)(\?.*)?$/,
                use: [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 1024,
                            fallback: {
                                loader: 'file-loader',
                                options: {
                                    name: 'img/[name].[hash:8].[ext]'
                                }
                            }
                        }
                    }
                ]
            },
            {
                test: /\.(ttf|woff|woff2|eot|svg)$/,
                use: [
                    {
                      loader: 'file-loader',
                      options: {
                        name: './font/[name].[ext]',
                      },
                    },
                ]
            }
        ]
    },
    plugins: [
        new VueLoaderPlugin(),
        new HtmlWebpackPlugin({
            template: 'public/index.html',
            favicon: 'public/favicon.png'
        }),
        new VueAutoRoutingPlugin({
          // Path to the directory that contains your page components.
          pages: 'src/views',

          // A string that will be added to importing component path (default @/pages/).
          importPrefix: '@views/'
        }),
        new Dotenv({
            path: environment ? `./config/environments/${environment}.env` : './.env'
        })
    ]
}
