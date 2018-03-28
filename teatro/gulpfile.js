var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();
var useref = require('gulp-useref');
var uglify = require('gulp-uglify');
var gulpIf = require('gulp-if');
var cssnano = require('gulp-cssnano');
var imagemin = require('gulp-imagemin');
var cache = require('gulp-cache');
var del = require('del');
var runSequence = require('run-sequence');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('watch', ['browserSync', 'copy', 'sass', 'javascript', 'useref'], function (){
    gulp.watch('app/assets/scss/**/*.scss', ['sass']); 
    gulp.watch('app/*.html', ['copy', browserSync.reload]); 
    gulp.watch('app/assets/js/**/*.js', ['javascript', browserSync.reload]); 
});

gulp.task('build', function (callback) {
    runSequence('clean:dist', 
      ['sass', 'useref', 'images', 'fonts'],
      callback
    )
})

gulp.task('default', function (callback) {
    runSequence(['sass','browserSync', 'watch'],
      callback
    )
})

gulp.task('copy', function () {
    return gulp.src('app/index.html')
        .pipe(gulp.dest('dist/'));
});

gulp.task('sass', function(){
    return gulp.src('app/assets/scss/styles.scss')
        .pipe(sass()) // Converts Sass to CSS with gulp-sass
        .pipe(gulp.dest('dist/css'))
        .pipe(browserSync.reload({
            stream: true
        }))
});

gulp.task('browserSync', function() {
    browserSync.init({
        server: {
        baseDir: 'dist/'
        },
    })
})

gulp.task('useref', function(){
    return gulp.src('app/*.html')
      .pipe(useref())
      .pipe(gulpIf('*.js', uglify()))
      // Minifies only if it's a CSS file
      .pipe(gulpIf('*.css', cssnano()))
      .pipe(gulp.dest('dist'))
});

gulp.task('images', function(){
    return gulp.src('app/assets/images/**/*.+(png|jpg|jpeg|gif|svg)')
    // Caching images that ran through imagemin
    .pipe(cache(imagemin({
        interlaced: true
    })))
    .pipe(gulp.dest('dist/images'))
});

gulp.task('fonts', function() {
    return gulp.src('app/assets/fonts/**/*')
    .pipe(gulp.dest('dist/fonts'))
})

gulp.task('clean:dist', function() {
    return del.sync('dist/');
})

gulp.task('javascript', function() {
    return gulp.src('app/assets/**/*.js')
      .pipe(sourcemaps.init())
      .pipe(sourcemaps.write())
      .pipe(gulp.dest('dist'));
});