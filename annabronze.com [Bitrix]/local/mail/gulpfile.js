var gulp = require('gulp');
var $ = require('gulp-load-plugins')();

gulp.task('sass', function () {
    return $.rubySass('src/sass', {style: 'expanded'})
        .pipe($.autoprefixer())
        .pipe(gulp.dest('src/css'));
});

gulp.task('inline-css', ['sass'], function() {
    return gulp.src('src/*.html')
        .pipe($.inlineCss())
        .pipe(gulp.dest('dist/'));
});

gulp.task('html-min', ['inline-css'], function () {
    return gulp.src('dist/**/*.html')
        .pipe($.minifyHtml({
            empty: true,
            spare: true,
            quotes: true
        }))
        .pipe(gulp.dest("dist"));
});

gulp.task('clean-images', function () {
    return gulp.src('dist/img', {read: false})
        .pipe($.clean());
});

gulp.task('images', ['clean-images'], function () {
    return gulp.src('src/img/**/*')
        .pipe($.imagemin({
            progressive: true
        }))
        .pipe(gulp.dest('dist/img'));
});

// http://www.mailgun.com/
/*var emailOptions = {
    user: 'api:key-6cf5033e549d9cbab533b2203345fff7',
    url: 'https://api.mailgun.net/v3/sandbox9f4bb9513aa74ec6b54c40333e014c9a.mailgun.org/messages',
    form: {
        from: '',
        to: 'gsu1234@mail.ru',
        subject: 'Anna Bronze'
    }
};*/

sendmail = require('gulp-mailgun');

gulp.task('send-email', function () {
    gulp.src( 'dist/index.html') // 
        .pipe(sendmail({
            key: 'key-6cf5033e549d9cbab533b2203345fff7', //
            sender: 'from@test.com',
            recipient: 'gsu1234@mail.ru',//,gsu4306@gmail.com
            subject: 'This is a test email'
        }));
});
/*
gulp.task('send-email', function () {
    return gulp.src('dist/index.html')
        .pipe($.email(emailOptions));
});
*/

gulp.task('watch', function () {
    gulp.watch(['src/sass/**/*.sass', 'src/**/*.html'], ['html-min']);
    gulp.watch('src/img/*', ['images']);
});

gulp.task('build', ['html-min', 'images']);
gulp.task('test', ['send-email']);
gulp.task('default', ['watch']);
