//Gruntfile
module.exports = function(grunt) {

  //Initializing the configuration object
  grunt.initConfig({
    vendorsPath : './vendor/assets',
    assetsPath : './resources/assets',
    publicAssets : './public/assets',
    fontsPath : './public/fonts',

    // Task configuration
    less: {
      dev: {
        files: {
          '<%= publicAssets %>/app.css' : '<%= assetsPath %>/less/app.less'
        }
      },
      prod: {
        options: {
          compress: true,
          yuicompress: true,
          optimization: 2
        },
        files: {
          '<%= publicAssets %>/app.css' : '<%= assetsPath %>/less/app.less'
        }
      }
    },
    jshint: {
      files: ['Gruntfile.js', '<%= assetsPath %>/js/*.js', '<%= assetsPath %>/js/*/*.js'],
      options: {
        // options here to override JSHint defaults
        globals: {
          jQuery: true,
          console: true,
          module: true,
          document: true
        }
      }
    },
    concat: {
      options: {
        separator: ';\n', // Avoid syntax error on Smart-Table concat
      },
      js_app: {
        src: [
          '<%= assetsPath %>/js/app.js',
        ],
        dest: '<%= publicAssets %>/admin.js',
      }
    },
    uglify: {
      options: {
        mangle: false
      },
      app: {
        files: {
          '<%= publicAssets %>/admin.js': '<%= publicAssets %>/admin.js',
        }
      }
    },
    php: {
      dist: {
        options: {
          keepalive: false,
          port: 8080,
          base: 'public',
          hostname: 'localhost',
          open: true,
          silent: true,
        }
      }
    },
    delta: {
      options: {
        livereload: true,
      },
      gruntfile: {
        files: [
          'Gruntfile.js'
        ],
        tasks: ['less:dev', 'jshint', 'concat']
      },
      less: {
        files: [
          '<%= assetsPath %>/less/**/*.less',
        ],
        tasks: ['less:dev']
      },
      js: {
        files: [
          '<%= assetsPath %>/js/**.js'
        ],
        tasks: ['jshint', 'concat']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-php');

  // Task definition
  grunt.registerTask('default', ['less:dev', 'jshint', 'concat']);
  grunt.registerTask('prod', ['less:prod', 'jshint', 'concat']);

  grunt.renameTask( 'watch', 'delta' );
  grunt.registerTask('watch', ['less:dev', 'jshint', 'concat', 'php:dist', 'delta']);

};
