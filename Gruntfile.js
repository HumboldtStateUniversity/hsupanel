module.exports = function(grunt) {

	// load all grunt tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	grunt.initConfig({
    uglify: {
    	target: {
      	files: {
        	'js/main.min.js': ['js/main.js']
      	}
    	}
  	},
		svgstore: {
			options: {
				prefix : 'icon-',
				svg: {
					viewBox : '0 0 30 30'
				}
			},
			default : {
				files: {
					'img/icons.svg': ['img/svg-icons/*.svg'],
				},
			},
		},
		compass: {
			dev: {
				options: {
					config: 'config.rb',
					force: true
				}
			}
		},
		watch: {
			sass: {
				files: ['scss/*.scss'],
				tasks: ['compass:dev']
			},
			js: {
				files: ['js/main.js'],
				tasks: ['uglify']
			},
			/* watch our files for change, reload */
			livereload: {
				files: ['*.html', 'templates/*.tpl.php', 'css/*.css', 'img/*', 'js/{main.js, plugins.min.js}'],
				options: {
					livereload: true
				}
			},
		},

	});

	grunt.registerTask('default', 'watch');


};
