const path = require('path');
const glob = require('glob');
const webpack = require('webpack');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const LiveReloadPlugin = require('webpack-livereload-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    mode: 'production',
    entry: ['../js-dev/index.js', '../css-dev/main.scss'],
    output: {
        filename: 'app.js',
        path: path.resolve(__dirname + './../', 'js')
    },
    devtool: 'source-map',
    watch: true,
    watchOptions: {
        ignored: '/node_modules/'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env'],
                        cacheDirectory: true
                    }
                }
            },
            {
                test: /\.(css|s?[ac]ss)$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                        loader: 'postcss-loader',
                        options: {
                            ident: 'postcss',
                            plugins: function (loader) {
                                return [
                                    require('postcss-import')({root: loader.resourcePath}),
                                    require('postcss-cssnext')({
                                        browsers: [
                                            "> 1%",
                                            "last 2 versions",
                                            "IE 8-9"
                                        ]
                                    }),
                                    require('cssnano')({
                                        'safe': true,
                                        'calc': false
                                    })
                                ];
                            }
                        }
                    },
                    'sass-loader'
                ]
            }
        ]
    },
    plugins: [
        new CleanWebpackPlugin([
            'js',
            'css',
            'img'
        ], {
            root: path.resolve(__dirname + './../'),
            verbose: true,
            dry: false
        }),
        new MiniCssExtractPlugin({
            filename: "../css/[name].css",
            chunkFilename: "[id].css"
        }),
        new CopyWebpackPlugin([{
            from: './../img-dev',
            to: './../img'
        }]),
        new ImageminPlugin({
            externalImages: {
                context: path.resolve(__dirname + './../'),
                sources: glob.sync('img/**')
            }
        }),
        new LiveReloadPlugin(),
        new webpack.HotModuleReplacementPlugin(),
    ],
    externals: {
        jquery: 'jQuery'
    }
};