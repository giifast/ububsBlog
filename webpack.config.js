const webpack = require('webpack');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const CleanWebpackPlugin = require("clean-webpack-plugin");
const CopyWebpackPlugin = require('copy-webpack-plugin');
const CompressionWebpackPlugin = require('compression-webpack-plugin')
const productionGzipExtensions = ['js', 'css']

module.exports = {
    // devtool: 'eval-source-map',
    // 开发环境
    devtool: 'cheap-module-eval-source-map',
    // 生产环境
    // devtool: 'cheap-module-source-map',
    // 入口文件
    entry: {
        "frontend/app": __dirname + "/resources/assets/frontend/js/app.js",
        "backend/app": __dirname + "/resources/assets/backend/js/app.js",
        "tools/app": __dirname + "/resources/assets/tools/js/app.js",
    },
    // externals: {
    //     'axios': 'axios',
    //     'vue': 'Vue',
    //     'vuex': 'Vuex',
    //     'vue-router': 'VueRouter',
    //     'vue-chartjs': 'VueChartJs',
    //     "iView": "iView"
    // },
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
                // loader: 'style!css!postcss!sass?sourceMap'
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
        new CompressionWebpackPlugin({
            filename: '[path].gz[query]',
            algorithm: 'gzip',
            test: new RegExp('\\.(' + productionGzipExtensions.join('|') + ')$'),
            threshold: 10240,
            minRatio: 0.8
        }),
        new webpack.BannerPlugin('版权所有，翻版必究'),
        new webpack.optimize.UglifyJsPlugin({ compress: { warnings: false } }),
        // 根据模版自动生成文件
        // new HtmlWebpackPlugin({
        //     template: __dirname + "/test/indexTest.tmpl.html"
        // }),
        // 为组件分配ID
        new webpack.optimize.OccurrenceOrderPlugin(),
        // new webpack.optimize.CommonsChunkPlugin({ names: ["vendors", "webpackAssets"] }),
        // 压缩js代码
        // new webpack.optimize.UglifyJsPlugin(),
        new ExtractTextPlugin("[name][hash].css"),
        // 清除原来的文件
        new CleanWebpackPlugin(['public/frontend/*.*', 'public/backend/*.*', 'public/tools/*.*', 'public/*.js', 'public/*.js.gz', 'public/*.css', 'public/*.css.gz'], {
            root: __dirname,
            verbose: true,
            dry: false
        }),
        // 插件将会把文件导出
        new CopyWebpackPlugin([{
            from: 'node_modules/mavon-editor/dist/highlightjs',
            to: __dirname + "/public/common/dist/highlightjs"
        }, {
            from: 'node_modules/mavon-editor/dist/markdown',
            to: __dirname + "/public/common/dist/markdown",
        }, {
            from: 'node_modules/mavon-editor/dist/katex',
            to: __dirname + "/public/common/dist/katex"
        }])
    ],
}