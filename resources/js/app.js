import './bootstrap';
import Alpine from 'alpinejs';

import '../css/app.css';   // Import app.css
import '../css/style.css'; // Import style.css


import exportToExcel from './exportToExcel.js';
import exportToExcel_branch from './exportToExcel_branch.js';
import.meta.env.BASE_URL = process.env.MIX_APP_URL || '/';


window.exportToExcel = exportToExcel;
window.exportToExcel_branch = exportToExcel_branch;

window.Alpine = Alpine;

Alpine.start();
