const path = require('path');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const LiveReloadPlugin = require('webpack-livereload-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

module.exports = {
    mode: 'production',
    entry: ['../js-dev/index.js', '../css-dev/main.scss'],
    output: {
        filename: 'app.js',
        path: path.resolve(__dirname + './../', 'js'),
        publicPath: path.resolve(__dirname + './../'),
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
                        cacheDirectory: true,
                        sourceMap: true
                    }
                }
            },
            {
                test: /\.(css|s?[ac]ss)$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            url: false,
                            sourceMap: true
                        }
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            ident: 'postcss',
                            sourceMap: true,
                            plugins: function (loader) {
                                return [
                                    require('postcss-import')({root: loader.resourcePath}),
                                    require('postcss-preset-env')({
                                        stage: 0,
                                        autoprefixer: {
                                            grid: true
                                        }
                                    }),
                                    require('cssnano')({
                                        'safe': true,
                                        'calc': false
                                    })
                                ];
                            }
                        }
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true
                        }
                    }
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
        new CopyWebpackPlugin([{
            from: './../img-dev',
            to: './../img'
        }]),
        new ImageminPlugin(),
        new MiniCssExtractPlugin({
            filename: "../css/[name].css",
            chunkFilename: "[id].css"
        }),
        new LiveReloadPlugin()
    ],
    externals: {
        jquery: 'jQuery'
    },
    optimization: {
        minimizer: [
            new UglifyJsPlugin({
                uglifyOptions: {
                    output: {
                        comments: false
                    }
                },
                sourceMap: true
            })
        ]
    }
};