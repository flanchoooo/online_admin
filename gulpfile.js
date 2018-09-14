var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();

gulp.task('js', function () {
    return gulp.src(['public/lib/font-awesome/svg-with-js/js/fontawesome-all.js','public/lib/jquery/dist/jquery.min.js','public/lib/bootstrap/dist/js/bootstrap.js','public/lib/select2/dist/js/select2.min.js','public/lib/pickadate/lib/picker.js','public/lib/pickadate/lib/picker.date.js','public/lib/angular/angular.min.js','public/js/controllers/*.js'])
        .pipe(plugins.concat('app.js'))
        .pipe(plugins.uglify())
        .pipe(gulp.dest('public/dist/js'))
});
gulp.task('watch', function () {
    return gulp.watch(['public/js/controllers/*.js'],['js']);
});
gulp.task('default',['watch','js']);


