var gulp        = require('gulp');
var sass        = require('gulp-sass');         // Sass compiler
var minifyCss   = require('gulp-minify-css');   // Minify css
var minifyJs    = require('gulp-uglify');       // Minify js
var rename      = require('gulp-rename');       // Rename minified files
var newer       = require('gulp-newer');        // Check for new files on directory
const imagemin  = require('gulp-imagemin');     // Image minify
const pngquant  = require('imagemin-pngquant'); // Plugin for imagemin for png files
var iconfont    = require('gulp-iconfont');     // Generate font icons from svg files
var consolidate = require('gulp-consolidate');  // Get template from file and put in another file

// Sass compiler
gulp.task('sass', function () {
	gulp.src(['../sass/**/*.sass','!../sass/templates/*.sass'])
		.pipe(sass({
			indentType: 'tab',
			indentWidth: 1
		}).on('error', sass.logError))
		.pipe(gulp.dest('../css'))
});

// Sass - watch directory
gulp.task('sass:watch', function(){
	gulp.watch('../sass/**/*.sass', ['sass']);
});


// Minify css
gulp.task('minify-css', function () {
	gulp.src('../css/main.css')
		.pipe(minifyCss())
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(gulp.dest('../css'));
});

// Minify css - watch directory
gulp.task('minify-css:watch', function(){
	gulp.watch('../css/main.css', ['minify-css']);
});

// Minify js 
gulp.task('minify-js', function() {
	return gulp.src(['./*.js','!./*.min.js'])
		.pipe(minifyJs())        
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(gulp.dest('./'));
});

// Minify js - watch directory
gulp.task('minify-js:watch', function(){
	gulp.watch(['./*.js','!./*.min.js'], ['minify-js']);
});

// Image minify
gulp.task('imagemin', function () {
	gulp.src(['../img-original/**', '!../img-original/{icons/,icons/**}'])
		.pipe(newer('../img'))
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngquant()],
			optimizationLevel: 3,
		}))
		.pipe(gulp.dest('../img'));
});

// Image minify - watch directory
gulp.task('imagemin:watch', function(){
	gulp.watch(['../img-original/**', '!../img-original/{icons/,icons/**}'], ['imagemin']);
});

// Font icons
gulp.task('font-icons', function(){
	return gulp.src('../img-original/icons/*.svg')
		.pipe(iconfont({ 
			fontName: 'wplay-icons',
			centerHorizontally: true,
			fontWeight: 600,
			normalize: true,
			formats: ['ttf', 'eot', 'woff', 'woff2', 'svg'],
		}))
		.on('glyphs', function(glyphs, options) {
			gulp.src('../sass/templates/font-icons.sass')
			.pipe(consolidate('lodash', {
				glyphs: glyphs,
				fontName: 'wplay-icons',
				fontPath: 'fonts/',
				fontHeight: 1100,
				className: 'wplay-icon'
				}))
				.pipe(gulp.dest('../sass/modules/'));
			})
		.pipe(gulp.dest('../css/fonts'));
});

// Font icons - watch directory
gulp.task('font-icons:watch', function(){
	gulp.watch('../img-original/icons/*.svg', ['font-icons']);
});

// Default task
gulp.task('default', ['sass:watch', 'minify-css:watch', 'minify-js:watch', 'imagemin:watch', 'font-icons:watch']);