'use strict';

var gulp = require('gulp'),
    pkg = require('./package.json'),
    toolkit = require('gulp-wp-toolkit');

require('gulp-stats')(gulp);
toolkit.extendConfig({
    theme: {
        name: "Koelsch",
        homepage: pkg.homepage,
        description: pkg.description,
        author: pkg.author,
        authoruri: pkg.authoruri,
        version: pkg.version,
        template: "genesis",
        license: pkg.license,
        licenceuri: pkg.licenseuri,
        textdomain: pkg.textdomain
    },
    css: {
        scss: {
            'frontend': {
                src: 'develop/scss/style.scss',
                dest: 'css/'
            },
            // 'admin': {
            //     src: 'develop/scss/admin.scss',
            //     dest: 'css/'
            // },
        }
    },
    js: {
        'theme': [
            'develop/js/jquery.main.js',
        ],
        'admin': [
          'develop/js/jquery.admin.js',
        ]
    },
    server: {
        url: 'http://localhost:8888/koelsch/'
    },
    dest:{
      i18nmo: 'assets/languages/',
      images: 'assets/images/',
      css: 'assets/',
      js: 'assets/js/',
    }
});

toolkit.extendTasks(gulp, /* Gulp task overrides. */);
