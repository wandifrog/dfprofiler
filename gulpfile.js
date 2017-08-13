/*
 * MIT License
 *
 * Copyright (c) 2017 Juan Timaná
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

/*
 * This script is used to build the site's assets.
 */

'use strict';

// require es6-promise
require('es6-promise').polyfill();

// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var jshint       = require('gulp-jshint');
var sass         = require('node-sass');
var uglify       = require('gulp-uglify');
var del          = require('del');
var cssnano      = require('gulp-cssnano');
var plumber      = require('gulp-plumber');
var autoprefixer = require('gulp-autoprefixer');
var runSequence  = require('run-sequence');
var file         = require('gulp-file');
var include      = require("gulp-include");

// Clean All
gulp.task('clean', function() {
  return del([
    'public/css',
    'public/fonts',
    'public/js',
  ]);
});

// Clean Phalcon Cache Task
gulp.task('clean:cache', function() {
  return del([
    'app/cache/*',
    '!app/cache/index.html'
  ]);
});

// Javacript Lint Task
gulp.task('jslint', function() {
  return gulp.src('src/js/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});

// Copy Bootstrap Fonts
gulp.task('fonts:bs', function() {
  return gulp.src('node_modules/bootstrap-sass/assets/fonts/bootstrap/*')
    .pipe(gulp.dest('public/fonts/bootstrap'));
});

// Copy FontAwesome Fonts
gulp.task('fonts:fa', function() {
  return gulp.src('node_modules/font-awesome/fonts/*')
    .pipe(gulp.dest('public/fonts'));
});

// Copy Custom Fonts
gulp.task('fonts', ['fonts:bs', 'fonts:fa'], function() {
  return gulp.src('src/fonts/*')
    .pipe(gulp.dest('public/fonts'));
});

// Copy & Minify JS
gulp.task('scripts', ['jslint'], function() {
  return gulp.src([
      'src/js/*.js',
      '!src/js/libraries.js',
      '!src/js/timer.js'
    ])
    .pipe(include())
      .on('error', console.log)
    .pipe(uglify())
    .pipe(gulp.dest('public/js'));
});

// CSS & JS Library assets
gulp.task('libraries:css', function() {
  return gulp.src('src/css/libraries.css')
  .pipe(include())
    .on('error', console.log)
  .pipe(cssnano())
  .pipe(gulp.dest('public/css'));
});
gulp.task('libraries:js', ['libraries:css'], function() {
  return gulp.src('src/js/libraries.js')
  .pipe(include())
    .on('error', console.log)
  .pipe(uglify())
  .pipe(gulp.dest('public/js'));
});

// Compile SCSS code
gulp.task('styles', ['fonts:bs'], function() {
  return sass.render({
      file: 'src/scss/styles.scss',
      outputStyle: 'compressed'
    }, function(error, result) {
      if (error) {
        console.log('Error compiling scss: ' + error.message);
      }
      else {
        var css = result.css.toString();

        file('styles.css', css)
        .pipe(autoprefixer({
          browsers: ['last 2 versions'],
          cascade: false
        }))
        .pipe(cssnano())
        .pipe(gulp.dest('public/css'));
      }
    });
});

// Watch Files For Changes
gulp.task('watch', function() {
  gulp.watch('src/js/*.js', ['jslint', 'scripts', 'libraries:js']);
  gulp.watch('src/css/*.css', ['libraries:css']);
  gulp.watch('src/scss/*.scss', ['styles']);
  gulp.watch('src/fonts/*', ['fonts']);
});

// Default Task
gulp.task('default', ['clean'], function(callback) {
  runSequence(['fonts', 'scripts', 'libraries:js'], 'styles', callback);
});
