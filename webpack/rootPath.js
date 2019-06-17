const path = require("path");

//https://github.com/ducksoupdev/vue-webpack-typescript/blob/master/template/config/helpers.js
const ROOT = path.resolve(__dirname, "..");

module.exports = function rootPath(args) {
  args = Array.prototype.slice.call(arguments, 0);
  return path.join.apply(path, [ROOT].concat(args));
}