const mix = require('laravel-mix');

mix.override(webpackConfig => {
    webpackConfig.module.rules.unshift({
        test: /\.m?js$/,
        resolve: {
            fullySpecified: false
        },
        exclude: /(node_modules|bower_components)/,
        use: {
            loader: 'babel-loader',
            options: {
                presets: ['@babel/preset-env'],
                sourceType: 'unambiguous'
            }
        }
    });
});

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       require('autoprefixer'),
   ])
   .minify('public/js/app.js') // Minifica el archivo JS
   .minify('public/css/app.css') // Minifica el archivo CSS
   .version();

