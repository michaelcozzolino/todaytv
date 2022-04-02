require('./bootstrap');
import jQuery from 'jquery';
window.$ = window.jQuery = require('jquery');

import 'bootstrap/dist/css/bootstrap.min.css';
require('bootstrap/dist/js/bootstrap.min');
require('./modernizr-svg');
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.min');
window.helpers = require('./helpers');
