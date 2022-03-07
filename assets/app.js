/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

global.$ = global.jQuery = require('jquery');
var dt = require("datatables.net");
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import('datatables.net-dt/css/jquery.dataTables.min.css');
import('datatables.net-buttons-dt/css/buttons.dataTables.min.css');

// start the Stimulus application
require('bootstrap');
require('bootstrap-autocomplete');


import 'datatables.net-dt';
import 'datatables.net-buttons-dt';
import 'datatables.net-buttons/js/buttons.colVis.js';
import 'datatables.net-datetime';
import 'datatables.net-responsive-dt';
import 'datatables.net-scroller-dt';
import 'datatables.net-select-dt';

import './form_validation';