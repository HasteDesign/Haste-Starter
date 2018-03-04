'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');

gulp.task('sass', function () {
  return gulp.src('./src/scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./assets/css'));
});

gulp.task('postcss', function () {
	return gulp.src('./assets/css/**/*.css')
	.pipe(sourcemaps.init())
	.pipe(autoprefixer({
		browsers: ['last 2 versions'],
		cascade: false
	}));
});

gulp.task('sass:build', gulp.series('sass', 'postcss') );

gulp.task('sass:watch', function () {
  gulp.watch('./src/scss/**/*.scss', gulp.series('sass', 'postcss'));
});
