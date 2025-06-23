const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
	entry: {
		"acf-signature": "./includes/js/acf-signature.js",
		"acf-signature-style": "./includes/scss/acf-signature.scss",
	},
	output: {
		path: path.resolve(__dirname, "assets"),
		filename: "js/[name].js",
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: "babel-loader",
					options: {
						presets: ["@babel/preset-env"],
					},
				},
			},
			{
				test: /\.scss$/,
				use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: "css/[name].css",
		}),
	],
	resolve: {
		alias: {
			signature_pad: path.resolve(
				__dirname,
				"node_modules/signature_pad/dist/signature_pad.min.js"
			),
		},
	},
	devtool: 'source-map',
};
