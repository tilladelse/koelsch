'use strict';

var gulp = require('gulp'),
    toolkit = require('gulp-wp-toolkit');

require('gulp-stats')(gulp);

toolkit.extendConfig({
    theme: {
        name: "Koelsch",
        homepage: "https://tilladelse.com",
        description: "Koelsch child theme created for the Genesis Framework.",
        author: "Tilladelse",
        authoruri: "https://tilladelse.com/",
        version: "1.0.0",
        tags: "one-column, two-columns, left-sidebar, right-sidebar, accessibility-ready, custom-background, custom-colors, custom-header, custom-menu, featured-images, footer-widgets, full-width-template, sticky-post, theme-options, threaded-comments, translation-ready",
        template: "genesis",
        license: "GPL-2.0+",
        licenceuri: "http://www.gnu.org/licenses/gpl-2.0.html",
        textdomain: "koelsch"
    },
    css: {
        scss: {
            'style-front': {
                src: 'src/scss/frontend.scss',
                dest: 'css/'
            }
        }
    },
    js: {
        'infinity-pro': [
            'develop/js/responsive-menus.js',
            'develop/js/match-height.js',
            'develop/js/global.js'
        ],
        'front-page': [
            'develop/js/front-page.js'
        ]
    },
    server: {
        url: 'http://localhost:8888/koelsch/'
    }
});

toolkit.extendTasks(gulp, /* Gulp task overrides. */);
