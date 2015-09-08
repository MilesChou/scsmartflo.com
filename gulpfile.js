var gulp = require('gulp');
var sass = require('gulp-sass');
var minifyCss = require('gulp-minify-css');
var concat = require('gulp-concat');

var files = {
    scss: [
        './assets/sass/*.scss'
    ],
    javascript: [
        './assets/javascript/*.js'
    ]
};

/**
 * 編譯sass
 */
gulp.task('sass', function () {
    gulp.src(files.scss)
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(minifyCss({compatibility: 'ie8'}))
        .pipe(gulp.dest('./public/css'));
});

/**
 * 壓縮angular
 */
gulp.task('javascript', function () {
    gulp.src(files.javascript)
        .pipe(concat('scsmartflo-compressed.js'))
        .pipe(gulp.dest('./public/js/'));
});

/**
 * 監控sass
 */
gulp.task('watch-sass', function () {
    gulp.watch(files.scss, ['sass']);
});

/**
 * 監控javascript
 */
gulp.task('watch-javascript', function () {
    gulp.watch(files.javascript, ['javascript']);
});

gulp.task('default', ['sass', 'javascript']);

/**
 * 監控sass, angular
 */
gulp.task('watch', ['sass', 'javascript', 'watch-sass', 'watch-javascript']);