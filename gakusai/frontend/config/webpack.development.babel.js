const webpack = require('webpack');

const ROOT = `${__dirname}/..`

const config = {

  /*
   [入力設定]
   JSの入力に関する設定を記述。
   vendorは各JS上で読み込む全ページ共通のライブラリを指定し、その他はページ単位で指定。
   todoの場合、todoページで必要なJSのみ読み込みバンドルする。
   もし、全ページで読み込みたくはないが複数ページで読み込みたいモジュールがある場合は、
   別途CommonsChunkPluginの設定をいじる必要あり。
   see: https://github.com/webpack/docs/wiki/Configuration#entry
   */
  entry: `./src/scripts/todo/index.js`,

  /*
   [出力設定]
   JSの出力に関する設定を記述
   publicPathは埋め込む画像などの参照に必要な（URLに組み込まれる）パスとして指定される。
   また、WebpackDevServerの起動時もAssetsの配信サーバーのURLとして機能する。
   本番も開発もバックもフロントもこのURL(publicPath)からJSなどを配信するため、
   バックエンドに合わせて指定する必要がある。
   see: https://github.com/webpack/docs/wiki/Configuration#output
   */
  output: {
    path: __dirname + '/../../webroot/scripts',
    filename: 'bundle.js',
    publicPath: '/webroot/',
  },

  module: {
    preLoaders: [
        {
            test: /\.tag$/,
            exclude: /node_modules/,
            loader: 'riotjs-loader',
            query: {
                type: 'babel'
            }
        }
    ],
    loaders: [

      /*
       [ES2015の読み込み]
       ES2015をbabelでトランスパイルして、ES5に変換する。
       ライブラリはトランスパイルする必要ないのでexcludeで指定。
       ES5の対応ブラウザ: http://kangax.github.io/compat-table/es5/
       see: https://github.com/babel/babel-loader
       */
      {
        test: /\.js$|\.tag$/,
        exclude: /(node_modules)/,
        loader: 'babel-loader',
        query: {
          // cacheDirectory: true // TODO: あとで検証。指定すると高速になるらしい

          //comments: false, // TODO: minify後にコメントが残るようなら設定
          //compact: true,
        }
      },

      /*
       [画像の読み込み]
       JSやCSS上で扱っている画像ファイルのURLを自動解決し、10Kバイト以下の画像ファイルはBase64で出力。
       Base64にしてるのは画像のHTTPリクエスト数を減らすことで表示を高速化できるため。
       see: https://webpack.github.io/docs/list-of-loaders.html#packaging
       */
      {
        test: /\.(jpg|png|gif)$/,
        loader: 'url-loader',
        query: {
          limit: 10240
        }
      }
    ]
  },

  resolve: {

    /*
     [ルートの定義]
     JSやSCSS上で他のモジュールをimportする際のルートパスの定義。
     これによって、import sum from ./../log.js を import sum from log.js と書けるようになる
     see: https://webpack.github.io/docs/configuration.html#resolve-root
     */
    root: [
      `${ROOT}/src/main/scripts`,
    ],
    extensions: ['', '.js', '.tag']
  },
  devtool: 'inline-source-map',

  plugins: [

    /*
     [使用ライブラリの共通化]
     Multi Page Application用の設定。HTMLでロードされる各JSごと（ページ、entryごと）で使用されてるライブラリを
     依存性を解決した上で共通化してくれる。これがあることで、各JSのファイルサイズを小さくできる。
     ただ、最初は巨大なライブラリJSを読み込む必要があるので初回ロード時だけ遅くなる。
     （グローバルをライブラリで汚染したくないのもあって使ってる）
     例）
     ① pageA.js: 1.4MB, pageB.js: 1.5MB
     ② vendor: 2.1MB, pageA.js: 15KB, pageB.js: 30KB
     ①のようなサイズのファイルが②のようになる。
     see: https://webpack.github.io/docs/list-of-plugins.html#commonschunkplugin
     see: https://github.com/webpack/docs/wiki/optimization#multi-page-app
     */
    // new webpack.optimize.CommonsChunkPlugin('vendor', 'vendor.js'),
    
    new webpack.ProvidePlugin({
      riot: 'riot'
    })
  ]
};

module.exports = config;