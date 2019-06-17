const path = require("path");
const rootPath = require("./rootPath");
const nodeExternals = require("webpack-node-externals");
const TsconfigPathsPlugin = require("tsconfig-paths-webpack-plugin");

module.exports = {
  entry: rootPath("src/Main.ts"),
  target: "node",
  externals: [nodeExternals()],
  output: {
    filename: "bundle.js",
    path: rootPath("build")
  },
  module: {
    rules: [
      {
        test: /\.tsx?$/,
        use: "ts-loader",
        exclude: /node_modules/
      }
    ]
  },
  resolve: {
    extensions: [".tsx", ".ts", ".js"],
    plugins: [new TsconfigPathsPlugin()]
  }
};
