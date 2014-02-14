module.exports = function(grunt){

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.initConfig({

        uglify: {
            dist: {
                files: {
                    'web/built/js/min.js': [
                        'web/app/js/jquery.min.js',
                        'web/app/js/hammer.jquery.js',
                        'web/app/js/modernizr.js',
                        'web/app/js/app.js'
                    ]
                }
            }
        },

        cssmin: {
            combine: {
                files: {
                    'web/built/css/min.css': ['web/app/css/css.css', 'web/app/css/app.css']
                }
            }
        },

        jshint: {
            all: ['app/Resources/public/js/*.js']
        },

        copy: {

            js: {
                files: [
                    {expand: true, cwd: 'app/Resources/public/', src: ['js/**'], dest: 'web/app/', filter: 'isFile'},
                    {src: 'bower_components/jquery/jquery.min.js', dest: 'web/app/js/jquery.min.js'},
                    {src: 'bower_components/hammerjs/hammer.js', dest: 'web/app/js/hammer.jquery.js'},
                    {src: 'bower_components/modernizr/modernizr.js', dest: 'web/app/js/modernizr.js'},
                ]
            },

            css: {
                files: [
                    {expand: true, cwd: 'app/Resources/public/', src: ['css/**'], dest: 'web/app/', filter: 'isFile'},
                ]
            }

        },

        watch: {

            js: {
                files: ['**/*.js'],
                tasks: ['js'],
                options: {
                    spawn: false
                }
            },

            scss: {
                files: ['**/*.scss'],
                tasks: ['css'],
                options: {
                    spawn: false
                }
            }
        },

        compass: {
            dist: {
                options: {
                    config: 'config.rb'
                }
            }
        }

    });

    grunt.registerTask('default', ['compass', 'copy', 'jshint', 'uglify', 'cssmin']);
    grunt.registerTask('js', ['copy:js', 'jshint', 'uglify']);
    grunt.registerTask('css', ['compass', 'copy:css', 'cssmin']);

};