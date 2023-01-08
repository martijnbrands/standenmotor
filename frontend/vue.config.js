const path = require("path");

module.exports = {
  outputDir: path.resolve(__dirname, '../backend/public'),
  transpileDependencies: [
    'vuetify'
  ],
  configureWebpack: {
    resolve: {
      alias: {
        "@": path.resolve(__dirname, './src')
      },
      extensions: ['.js', '.vue', '.json']
    }
  }
}