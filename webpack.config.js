const webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const CleanWebpackPlugin = require("clean-webpack-plugin");
module.exports = {
    // devtool: 'eval-source-map',
    // 开发环境
    devtool: 'cheap-module-eval-source-map',
    // 生产环境cheap-module-source-map
    // 入口文件
    entry: {
        "frontend/app": __dirname + "/resources/assets/frontend/js/app.js",
        "backend/app": __dirname + "/resources/assets/backend/js/app.js",
    },
    output: {
        path: __dirname + "/public/", //打包后的文件存放的地方
        // chunkFilename: "[name][hash].js",
        publicPath: '/public/',
        filename: "[name][hash].js"
        // filename: "bundle.js" //打包后输出文件的文件名
    },
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.common.js'
        }
    },
    module: {
        rules: [{
                test: /\.vue$/,
                loader: 'vue-loader'
            }, {
                test: /(\.jsx|\.js)$/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ['es2015']
                    }
                },
                exclude: /node_modules/
            }, {
                test: /\.css$/,
                use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: ["css-loader"]
                })
            }, {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: ["css-loader", "sass-loader"]
                })
                // loader: ExtractTextPlugin.extract("style", "css!sass")
            }, {
                test: /\.(png|jpg|gif|svg)$/i,
                use: [
                    // 当图片大小大于1000byte时，以[name]-[hash:5].[ext]的形式输出
                    // 当图片大小小于1000byte时，以baseURL的形式输出
                    'url-loader?limit=1000&name=[name]-[hash:5].[ext]',
                    // 压缩图片
                    'image-webpack-loader'
                ]
            },
            {
                test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/,
                loader: 'url-loader',
                options: {　　　　　　　　 // 这里打包后可以把所有的字体库都放在fonts文件夹中
                    name: 'fonts/[hash].[ext]'
                }
            }
        ]
    },
    plugins: [
        new webpack.BannerPlugin('版权所有，翻版必究'),
        // new webpack.optimize.CommonsChunkPlugin('vendor',  'vendor.js'),
        // 根据模版自动生成文件
        // new HtmlWebpackPlugin({
        //     template: __dirname + "/test/indexTest.tmpl.html"
        // }),
        // 为组件分配ID
        new webpack.optimize.OccurrenceOrderPlugin(),
        new webpack.optimize.UglifyJsPlugin({
            mangle: {
                except: ['$super', '$', 'exports', 'require', 'module', '_']
            },
            compress: {
                warnings: false
            },
            output: {
                comments: false,
            }
        }),
        // new webpack.optimize.CommonsChunkPlugin({ names: ["vendors", "webpackAssets"] }),
        // 压缩js代码
        // new webpack.optimize.UglifyJsPlugin(),
        new ExtractTextPlugin("[name][hash].css"),
        // 清除原来的文件
        new CleanWebpackPlugin(['public/frontend/*.*', 'public/backend/*.*', 'public/*.js', 'public/*.css'], {
            root: __dirname,
            verbose: true,
            dry: false
        })
    ],
}