module.exports = function(grunt) {

	// To support SASS/SCSS or Stylus, just install
	// the appropriate grunt package and it will be automatically included
	// in the build process, Sass is included by default:
	//
	// * for SASS/SCSS support, run `npm install --save-dev grunt-contrib-sass`
	// * for Stylus/Nib support, `npm install --save-dev grunt-contrib-stylus`

	var npmDependencies = require('./package.json').devDependencies;
	var hasSass = npmDependencies['grunt-contrib-sass'] !== undefined;
	var hasStylus = npmDependencies['grunt-contrib-stylus'] !== undefined;

	grunt.initConfig({

		// Watches for changes and runs tasks
		watch : {
			sass : {
				files : ['assets/scss/**/*.scss'],
				tasks : (hasSass) ? ['sass:dev'] : null,
				options : {
					spawn: false,
					livereload : true
				}
			},
			stylus : {
				files : ['assets/stylus/**/*.styl'],
				tasks : (hasStylus) ? ['stylus:dev'] : null,
				options: {
					livereload : true
				}
			},
			js : {
				files : ['assets/javascripts/**/*.js'],
				tasks : ['jshint'],
				options : {
					livereload : true
				}
			},
			php : {
				files : ['**/*.php'],
				options : {
					livereload : true
				}
			}
		},

		// JsHint your javascript
		jshint : {
			all : ['assets/javascripts/*.js', '!assets/javascripts/modernizr.js', '!assets/javascripts/js/*.min.js', '!assets/javascripts/vendor/**/*.js'],
			options : {
				browser: true,
				curly: false,
				eqeqeq: false,
				eqnull: true,
				expr: true,
				immed: true,
				newcap: true,
				noarg: true,
				smarttabs: true,
				sub: true,
				undef: false
			}
		},

		// Dev and production build for sass
		sass : {
			production : {
				files : [
					{
						src : ['**/*.scss', '!**/_*.scss'],
						cwd : 'assets/scss',
						dest : 'assets/stylesheets',
						ext : '.css',
						expand : true
					}
				],
				options : {
					style : 'compressed'
				}
			},
			dev : {
				files : [
					{
						src : ['**/*.scss', '!**/_*.scss', '!rare.scss', '!**/rare/*.scss', '!vendor/**/*.scss'],
						cwd : 'assets/scss',
						dest : 'assets/stylesheets',
						ext : '.css',
						expand : true
					}
				],
				options : {
					style : 'expanded',
				}
			},
			rare : {
				files : [
					{
						src : ['rare.scss'],
						cwd : 'assets/scss',
						dest : 'assets/stylesheets',
						ext : '.css',
						expand : true
					}
				],
				options : {
					style : 'expanded'
				}
			}
		},
		// Dev and production build for stylus
		stylus : {
			production : {
				files : [
					{
						src : ['**/*.styl', '!**/_*.styl'],
						cwd : 'assets/stylus',
						dest : 'assets/stylesheets',
						ext: '.css',
						expand : true
					}
				],
				options : {
					compress : true
				}
			},
			dev : {
				files : [
					{
						src : ['**/*.styl', '!**/_*.styl'],
						cwd : 'stylus',
						dest : 'css',
						ext: '.css',
						expand : true
					}
				],
				options : {
					compress : false
				}
			},
		},

		// Bower task sets up require config
		bower : {
			all : {
				rjsConfig : 'assets/javascripts/global.js'
			}
		},

		// Require config
		requirejs : {
			production : {
				options : {
					name : 'global',
					baseUrl : 'js',
					mainConfigFile : 'assets/javascripts/global.js',
					out : 'assets/javascripts/optimized.min.js'
				}
			}
		},

		// Image min
		imagemin : {
			production : {
				files : [
					{
						expand: true,
						cwd: 'images',
						src: '**/*.{png,jpg,jpeg}',
						dest: 'images'
					}
				]
			}
		},

		// SVG min
		svgmin: {
			production : {
				files: [
					{
						expand: true,
						cwd: 'images',
						src: '**/*.svg',
						dest: 'images'
					}
				]
			}
		},

		// Copy
		copy: {
			jquery: {
				files: [
					{src: ['bower_components/jquery/dist/jquery.js'], dest: 'assets/javascripts/vendor/jquery/jquery.js'}
				]
			},
			fastclick: {
				files: [
					{src: ['bower_components/fastclick/lib/fastclick.js'], dest: 'assets/javascripts/vendor/fastclick/fastclick.js'}
				]
			},
			modernizr: {
				files: [
					{src: ['bower_components/modernizr/modernizr.js'], dest: 'assets/javascripts/vendor/modernizr/modernizr.js'}
				]
			},
			bourbon: {
				expand: true,
				cwd: 'bower_components/bourbon/dist',
				src: '**',
				dest: 'assets/scss/vendor/bourbon'
			},
			susy: {
				expand: true,
				cwd: 'bower_components/susy/sass',
				src: '**',
				dest: 'assets/scss/vendor/susy'
			},
			sass_mediqueries: {
				files: [
					{src: ['bower_components/sass-mediaqueries/_media-queries.scss'], dest: 'assets/scss/vendor/sass-mediaqueries/_media-queries.scss'}
				]
			},
		},

		concat: {
			options: {
				separator: ';'
			},
			dist: {
				src: [
					'assets/javascripts/vendor/fastclick/fastclick.js'
				],
				dest: 'assets/javascripts/plugins.js'
			}

		},

		browserSync: {
			bsFiles: {
				src : ['assets/stylesheets/*.css', '*.php']
			},
			options: {
				proxy: "wordpress.lcl",
				watchTask: true,
				debugInfo: true,
			},

		}

	});

	// Default task
	grunt.registerTask('default', ['copy' , 'concat', 'browserSync', 'watch']);

	// Build task
	grunt.registerTask('build', function() {
		var arr = ['jshint'];

		if (hasSass) {
			arr.push('sass:production');
		}

		if (hasStylus) {
			arr.push('stylus:production');
		}

		arr.push('imagemin:production', 'svgmin:production', 'requirejs:production');

		return arr;
	});

	// Template Setup Task
	grunt.registerTask('setup', function() {
		var arr = [];

		if (hasSass) {
			arr.push['sass:dev'];
		}

		if (hasStylus) {
			arr.push('stylus:dev');
		}

		arr.push('bower-install');
	});

	// Load up tasks
	if (hasSass) {
		grunt.loadNpmTasks('grunt-contrib-sass');
	}

	if (hasStylus) {
		grunt.loadNpmTasks('grunt-contrib-stylus');
	}
	
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-bower-requirejs');
	grunt.loadNpmTasks('grunt-contrib-requirejs');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-svgmin');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-browser-sync');


	// Run bower install
	grunt.registerTask('bower-install', function() {
		var done = this.async();
		var bower = require('bower').commands;
		bower.install().on('end', function(data) {
			done();
		}).on('data', function(data) {
			console.log(data);
		}).on('error', function(err) {
			console.error(err);
			done();
		});
	});

};
