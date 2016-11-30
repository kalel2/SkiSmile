'use strict';
var gulp = require('gulp'),
    plugins = require('gulp-load-plugins')(),
    mains = require('main-bower-files'),
    concatCss = require('gulp-concat-css'),
    minifyCss = require('gulp-minify-css'),
    filter = require('gulp-filter');

var paths = {
    dist: {
        js: './web/dist/js/',
        css: './web/dist/css/',
        fontsMain: './web/dist/fonts/',
        fonts: './web/dist/fonts/roboto/'
    },
    src: {
        less : './src/SkiSmileBundle/Resources/public/less/app.less'
    },
    srcAdmin: {
        less : './src/SkiSmileAdminBundle/Resources/public/less/admin.less'
    },
    bower: './bower_components/',
    npm: './node_modules/',
    font: './bower_components/materialize/dist/fonts/roboto/*',
    fontMaterialize: './bower_components/mdi/fonts/*',
    materializeCss: './bower_components/materialize/dist/css/materialize.min.css',
    materializeJs: './bower_components/materialize/dist/js/materialize.min.js'
};
/**
 * VENDOR tasks
 */
gulp.task('vendor:css', function() {
    var filterCss = filter('**/*.css');
    return gulp.src(mains())
        .pipe(filterCss)
        .pipe(plugins.concatCss('vendor.min.css'))
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.minifyCss({keepSpecialComments: 0}))
        .pipe(plugins.sourcemaps.write('.'))
        .pipe(gulp.dest(paths.dist.css));
});
gulp.task('vendor:js', function() {
    var filterJS = filter('**/*.js');
    return gulp.src(mains())
        .pipe(filterJS)
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.concat('vendor.min.js'))
        .pipe(plugins.uglify())
        .pipe(plugins.sourcemaps.write('.'))
        .pipe(gulp.dest(paths.dist.js));
});
gulp.task('vendor:fonts', function() {
    return gulp.src(paths.font)
        .pipe(gulp.dest(paths.dist.fonts));
});
gulp.task('vendor:mdi-fonts', function() {
    return gulp.src(paths.fontMaterialize)
        .pipe(gulp.dest(paths.dist.fontsMain));
});

gulp.task('vendor', [
    'vendor:js',
    'vendor:css'
], function() {
    gulp.src('')
        .pipe(plugins.notify('task VENDOR is completed'));
});
gulp.task('app-less', function() {
    return gulp.src(paths.src.less)
        .pipe(plugins.less())
        .pipe(plugins.minifyCss())
        .pipe(plugins.rename('app.min.css'))
        .pipe(gulp.dest(paths.dist.css));
});
gulp.task('admin-less', function() {
    return gulp.src(paths.srcAdmin.less)
        .pipe(plugins.less())
        .pipe(plugins.minifyCss())
        .pipe(plugins.rename('admin.min.css'))
        .pipe(gulp.dest(paths.dist.css));
});
