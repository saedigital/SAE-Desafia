const merge = require("webpack-merge");
const NodemonPlugin = require( 'nodemon-webpack-plugin' ) // Ding
const common = require("./webpack.common.js");
const rootPath = require("./rootPath");

module.exports = merge(common, {
  mode: "development",

  devtool: "cheap-eval-source-map",

  plugins: [
    new NodemonPlugin()
  ]
});
