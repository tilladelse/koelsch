'use strict';

var gulp = require('gulp'),
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
                src: 'develop/scss/frontend-bundle.scss',
                dest: 'css/'
            },
            'frontend': {
                src: 'develop/scss/admin.scss',
                dest: 'css/'
            },
        }
    },
    js: {
        'theme': [
            'develop/js/responsive-menus.js',
            'develop/js/match-height.js',
            'develop/js/global.js'
        ]
    },
    server: {
        url: 'http://localhost:8888/koelsch/'
    }
});

toolkit.extendTasks(gulp, /* Gulp task overrides. */);
