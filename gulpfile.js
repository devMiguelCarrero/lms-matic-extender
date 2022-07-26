const gulp = require("gulp");
const zip = require("gulp-zip");
const M = require("minimatch");

const bundle = () => {
  return gulp
    .src([
      "**/*",
      "!node_modules/**",
      "!vendor/**",
      "!src/**",
      "!bundled/**",
      "!gulpfile.js",
      "!package.json",
      "!package-lock.json",
      "!webpack.config.js",
      "!README.md",
      "!gitignore",
    ])
    .pipe(zip("lms-matic-extender.zip"))
    .pipe(gulp.dest("bundled"));
};

exports.bundle = bundle;
