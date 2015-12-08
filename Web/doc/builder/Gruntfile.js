module.exports = function(grunt){
    grunt.option('in_array', function(search, array){
        for(var i in array){
            if(array[i] == search){
                return true;
            }
        }
        return false;
    });
    grunt.option('isNoCopy', function(src){
        var arr = [
                      'protected/library/framework', 'protected/runtime',
                      'public/fonts'
                  ],
            re = new RegExp(arr.join('|'), 'igm');
        return re.test(src);
    });

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        dirs: {
            src: {
                root: '../../',
                assets: '<%= dirs.src.root %>public/'
            },
            dest: {
                root: 'dist/',
                assets: '<%= dirs.dest.root %>public/'
            },
        },

        copy: {
            init: {
                expand: true,
                cwd: '<%= dirs.src.root %>',
                src: ['protected/**', 'public/**'],
                dest: '<%= dirs.dest.root %>'
            },
            main: {
                files: [
                  {
                      expand: true,
                      flatten: true,
                      src: ['<%= dirs.src.assets %>js/lib/bootstrap/fonts/*'],
                      dest: '<%= dirs.dest.assets %>fonts/',
                      filter: 'isFile'
                  },
                ]
            },
            basic: {
                files: [
                    {
                        expand: true,
                        cwd: '<%= dirs.src.root %>',
                        src: ['protected/**', 'public/**'],
                        dest: '<%= dirs.dest.root %>',
                        filter: function(src){
                            return !grunt.option('isNoCopy')(src);
                        }
                    }
                ]
            }
        },

        concat: {
            options: {
                // separator: ';',
                stripBanners: true
            },
            basic: {
                src: ['<%= dirs.src.assets %>js/lib/jquery.min.js',
                      '<%= dirs.src.assets %>js/lib/bootstrap/js/bootstrap.js',
                      '<%= dirs.src.assets %>js/lib/hammer.min.js',
                      '<%= dirs.src.assets %>js/lib/jquery.hammer.js',
                      '<%= dirs.src.assets %>js/lib/template.js',
                      '<%= dirs.src.assets %>js/lib/sprintf.min.js',
                      '<%= dirs.src.assets %>js/lib/xss.js',
                      '<%= dirs.src.assets %>js/lib/jquery.custom.js',
                      '<%= dirs.src.assets %>js/lib/jquery.lazyload.js'],
                dest: '<%= dirs.dest.assets %>js/libs.js'
            },
            combine: {
                src: [
                    '<%= dirs.dest.assets %>js/libs.js',
                    '<%= dirs.src.assets %>js/chelper.js'
                ],
                dest: '<%= dirs.dest.assets %>js/all.uncompress.js'
            }
        },

        asset_cachebuster: {
            options: {
                buster: Date.now(),
                ignore: [],
                htmlExtension: 'php'
            },
            afterConcat: {
                files: {
                  '<%= dirs.dest.assets %>js/all.buster.js': ['<%= dirs.dest.assets %>js/all.uncompress.js']
                }
            },
            beforeCssmin: {
                files: [
                    {
                        expand: true,
                        cwd: '<%= dirs.src.assets %>',
                        src: ['css/**/*.css'],
                        dest: '<%= dirs.dest.assets %>'
                    },
                    {
                        '<%= dirs.dest.assets %>js/lib/bootstrap/css/bootstrap.buster.css': '<%= dirs.src.assets %>js/lib/bootstrap/css/bootstrap.min.css'
                    }
                ]
            },
            build: {
                files: [{
                  expand: true,
                  cwd: '<%= dirs.dest.root %>',
                  src: ['protected/views/**/*.{html,php,css,js}'],
                  dest: '<%= dirs.dest.root %>'
                }]
            }
        },

        strip: {
            built: {
                src: '<%= dirs.dest.assets %>js/all.buster.js',
                dest: '<%= dirs.dest.assets %>js/all.built.js'
            }
        },

        uglify: {
            options: {
                banner: '/*! <%= pkg.title %> - v<%= pkg.version %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            build: {
                files: {
                    '<%= dirs.dest.assets %>js/all.js': ['<%= dirs.dest.assets %>js/all.built.js']
                }
            }
        },

        replace: {
            beforeCssmin: {
                src: ['<%= dirs.dest.assets %>js/lib/bootstrap/css/bootstrap.buster.css'],
                overwrite: true,
                replacements: [{
                    from: '../fonts/',
                    to: '/fonts/'
                }]
            }
        },

        cssmin: {
            options: {
              banner: '<%= uglify.options.banner %>'
            },
            combine: {
              files: [
                  {
                    '<%= dirs.dest.assets %>css/all.css': ['<%= dirs.dest.assets %>js/lib/bootstrap/css/bootstrap.buster.css', '<%= dirs.dest.assets %>css/main.css'],
                    '<%= dirs.dest.assets %>css/error.css': '<%= dirs.dest.assets %>css/error.css',
                    '<%= dirs.dest.assets %>css/m/tmp.css': ['<%= dirs.dest.assets %>js/lib/bootstrap/css/bootstrap.buster.css', '<%= dirs.dest.assets %>css/m/main.css'],
                    '<%= dirs.dest.assets %>css/m/all.css': ['<%= dirs.dest.assets %>css/m/tmp.css', '<%= dirs.dest.assets %>css/m/*.css', '!<%= dirs.dest.assets %>css/m/all.css', '!<%= dirs.dest.assets %>css/m/main.css']
                  },
              ]
            }
        },

        imagemin: {
            dynamic: {
              options: {
                  optimizationLevel: 7
              },
              files: [{
                  expand: true,
                  cwd: '<%= dirs.src.assets %>images/',
                  src: ['**/*.{png,jpg,gif}'],
                  dest: '<%= dirs.dest.assets %>/images/'
              }]
            }
        },

        clean: {
            js: [
              '<%= dirs.dest.assets %>js/lib/*',
              '!<%= dirs.dest.assets %>js/lib/calendar',
              '!<%= dirs.dest.assets %>js/lib/photoswipe',
              '!<%= dirs.dest.assets %>js/lib/qiniu',
              '!<%= dirs.dest.assets %>js/lib/fancySelect.js',
              '!<%= dirs.dest.assets %>js/lib/toe.min.js',
              '<%= dirs.dest.assets %>js/*.js',
              '!<%= dirs.dest.assets %>js/all.js'
            ],
            css: [
              '<%= dirs.dest.assets %>css/main.css',
              '<%= dirs.dest.assets %>css/m/*.css',
              '!<%= dirs.dest.assets %>css/m/all.css'
            ],
            other: [
              '<%= dirs.dest.root %>protected/runtime/*'
            ]
        }
    });

    require('load-grunt-tasks')(grunt);

    grunt.registerTask('init', [
        'copy:init', 'copy:main', 'concat:basic', 'concat:combine',
        'asset_cachebuster:afterConcat', 'strip', 'uglify',
        'asset_cachebuster:beforeCssmin', 'replace:beforeCssmin',
        'cssmin', 'asset_cachebuster:build', 'imagemin', 'clean'
    ]);

    grunt.registerTask('default', [
        'copy:basic', 'concat:basic', 'concat:combine',
        'asset_cachebuster:afterConcat', 'strip', 'uglify',
        'asset_cachebuster:beforeCssmin', 'replace:beforeCssmin',
        'cssmin', 'asset_cachebuster:build', 'imagemin', 'clean'
    ]);
};