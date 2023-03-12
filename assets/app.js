/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
// You can specify which plugins you need
import { Tooltip, Toast, Popover } from 'bootstrap';

// start the Stimulus application
import './bootstrap';

const $ = require('jquery');
global.$ = global.jQuery = $;

$("#datatable").DataTable(
    {
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
        }
    }
);

// Datatable (plugin jquery) pour bootstrap
import './jquery.dataTables.js';
import './dataTables.bootstrap5';
import './styles/dataTables.bootstrap5.css';