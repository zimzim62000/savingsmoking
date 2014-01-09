module.exports = function(grunt){

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-copy');

    var file_js = ['web/app/js/zepto.js', 'web/app/js/zepto.js', 'web/app/js/zepto.js'];

    grunt.initConfig({

        uglify: {
            dist: {
                files: {
                    'web/built/js/min.js': [
                        'web/app/js/zepto.js',
                        'app/Resources/public/js/zepto.fx.js',
                        'web/app/js/app.js'
                    ]
                }
            }
        },

        jshint: {
            all: ['app/Resources/public/js/*.js']
        },

        copy: {
            main: {
                files: [
                    {expand: true, cwd: 'app/Resources/public/', src: ['css/**', 'js/**'], dest: 'web/app/', filter: 'isFile'},
                    {src: 'bower_components/jquery/jquery.min.js', dest: 'web/app/js/jquery.min.js'},
                ]
            }
        }


    });

    grunt.registerTask('default', ['copy', 'jshint', 'uglify'])

};