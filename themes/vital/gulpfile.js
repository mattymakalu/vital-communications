var gulp = require('gulp'),
  sass = require('gulp-sass'),
  autoprefixer = require('gulp-autoprefixer'),
  concat = require('gulp-concat'),
  uglify = require('gulp-uglify');


// Compile sass to compressed css andd add vendor prefixes
gulp.task('styles', function () {
  gulp.src('./sass/style.scss')
    .pipe(sass({
      outputStyle: 'compressed',
    }))
    .on('error', function (error) {
      console.log('- - - ERROR - - - \n' + error.message);
    })
    .pipe(autoprefixer({
      browsers: ['> 1%', 'last 2 versions', 'Firefox >= 20'],
    }))
    .pipe(gulp.dest('./css'));
});

// Watch sass and js changes
gulp.task('watch', function() {
  gulp.watch('sass/**/*.scss', ['styles']);
});

// default task
gulp.task('default', ['watch']);