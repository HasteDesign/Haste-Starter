// Const
const webpack = require('webpack'); //to access built-in plugins
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const path = require('path');

// ExtractPlugin - Multiple instances
// Configure individual stylesheet generation to use correctly with wp_enqueue_style
const extractMain = new ExtractTextPlugin('css/main.min.css');
const extractAdmin = new ExtractTextPlugin('css/admin.min.css');
const extractEditor = new ExtractTextPlugin('css/editor.min.css');

const config = {
	entry: {
		main: [
			'./src/js/main.js',
			'./src/scss/main.scss',
			'./src/scss/admin-style.scss',
			'./src/scss/editor-style.scss',
		]
	},
	// Output js in /js subfolder
	output: {
    	filename: 'js/[name].min.js',
    	path: path.resolve(__dirname, 'assets')
	},

	resolve: {
		extensions: ['.js']
	},

	// Configure the rules to generate files
	// TO-DO: check for a better solution to match filenames to call the
	// correct extract{NAME} instance
	module: {
        rules: [{
			// Generates main.min.css
			test: /\main.(scss)$/,
		    use: extractMain.extract({ fallback: 'style-loader', use: [
				{
					loader: 'css-loader',
					options: {
						sourceMap: true,
						url: false
					}
				},
				{ loader: 'postcss-loader', options: { sourceMap: true } },
				{ loader: 'sass-loader', options: { sourceMap: true } }
			]}),
			exclude: /node_modules/
        },
		{
			// Generates admin.min.css
			test: /\admin-style.(scss)$/,
		    use: extractAdmin.extract({ fallback: 'style-loader', use: [
				{
					loader: 'css-loader',
					options: {
						sourceMap: true,
						url: false
					}
				},
				{ loader: 'postcss-loader', options: { sourceMap: true } },
				{ loader: 'sass-loader', options: { sourceMap: true } }
			]}),
			exclude: /node_modules/
        },
		{
			// Generates editor.min.css
			test: /\editor-style.(scss)$/,
		    use: extractEditor.extract({ fallback: 'style-loader', use: [
				{
					loader: 'css-loader',
					options: {
						sourceMap: true,
						url: false
					}
				},
				{ loader: 'postcss-loader', options: { sourceMap: true } },
				{ loader: 'sass-loader', options: { sourceMap: true } }
			]}),
			exclude: /node_modules/
        },
		{
			test: /\.css$/,
			use: ExtractTextPlugin.extract([
				{
					loader: "css-loader",
					options: {
						sourceMap: true,
						url: false,
						alias: {
			            	"../fonts/bootstrap": "bootstrap-sass/assets/fonts/bootstrap"
						}
					}
				}
			]),
		},
		{
			// URL Loader - used if url are set to true in css-loader
        	test: /\.(png|jpg|gif|svg|eot|ttf|woff|woff2)$/,
        	loader: 'url-loader',
        	options: {
          		limit: 10000
        	}
      	},
		{ test: /\.html$/, loader: 'raw-loader', exclude: /node_modules/ },
		]
    },

	// PLugins used by WebPack
	plugins: [
		new webpack.optimize.UglifyJsPlugin( { sourceMap: true } ),
  		extractMain,
		extractAdmin,
		extractEditor,
		new webpack.ProvidePlugin({
			$: 'jquery',
			jQuery: 'jquery',
			'window.jQuery': 'jquery',
			Popper: ['popper.js', 'default'],
			// In case you imported plugins individually, you must also require them here, example:
			// Util: "exports-loader?Util!bootstrap/js/dist/util",
		})
	]
};

module.exports = config;
