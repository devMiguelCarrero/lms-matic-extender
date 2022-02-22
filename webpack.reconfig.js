const path = require("path");
const autoprefixer = require("autoprefixer");
const MiniCSSExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");

module.exports = (env, argv) => {
  function isDevelopment() {
    return argv.mode === "development";
  }

  var config = {
    entry: {
      "cpt/course/course": "./src/CPT/Course/Course.js",
      "cpt/course/edit": "./src/CPT/Course/Edit.js",
      "cpt/lesson/lesson": "./src/CPT/Lesson/Lesson.js",
      "cpt/lesson/edit": "./src/CPT/Lesson/edit.js",
    },
    output: {
      filename: "[name].js",
      path: path.resolve(__dirname, "./dist"),
    },
    optimization: {
      minimizer: [
        // For webpack@5 you can use the `...` syntax to extend existing minimizers (i.e. `terser-webpack-plugin`), uncomment the next line
        // `...`,
        new TerserPlugin(),
        new CssMinimizerPlugin(),
      ],
      minimize: !isDevelopment(),
    },
    plugins: [
      new CleanWebpackPlugin(),
      new MiniCSSExtractPlugin({
        chunkFilename: "[id].css",
        filename: "[name].css",
      }),
    ],
    devtool: isDevelopment() ? "cheap-module-source-map" : "source-map",
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: "babel-loader",
            options: {
              plugins: ["@babel/plugin-proposal-class-properties"],
              presets: [
                "@babel/preset-env",
                [
                  "@babel/preset-react",
                  {
                    pragma: "wp.element.createElement",
                    pragmaFrag: "wp.element.Fragment",
                    development: isDevelopment(),
                  },
                ],
              ],
            },
          },
        },
        {
          test: /\.(sa|sc|c)ss$/,
          use: [
            MiniCSSExtractPlugin.loader,
            "css-loader",
            {
              loader: "postcss-loader",
              options: {
                postcssOptions: {
                  plugins: [autoprefixer()],
                },
              },
            },
            "sass-loader",
          ],
        },
      ],
    },
    externals: {
      jquery: "jQuery",
      "@wordpress/i18n": ["wp", "i18n"],
      "@wordpress/element": ["wp", "element"],
      "@wordpress/data": ["wp", "data"],
      "@wordpress/scripts": ["wp", "scripts"],
    },
  };
  return config;
};
